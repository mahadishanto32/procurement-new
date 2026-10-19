<?php
/**
 * Laravel 8 -> Laravel 12 route converter.
 *
 * Usage (run from your project root):
 *   php convert-routes.php routes/modules/hr.php routes/modules/hr.new.php
 *
 * What it does
 *  - 'Hr\Foo\BarController@index'  ->  [BarController::class, 'index']
 *  - Route::group(['prefix'=>..,'namespace'=>..,'middleware'=>..], fn) -> Route::prefix()->middleware()->group()
 *    (the 'namespace' option is resolved and removed; it no longer exists in Laravel 12)
 *  - Route::resource('x', 'Ctrl') -> Route::resource('x', Ctrl::class)
 *  - Adds the `use` statements (aliasing controllers that share a short name)
 *  - Fixes invalid params such as {  arg}
 *  - Reports duplicate routes and controller files that do not exist (case-sensitive)
 */

$in       = $argv[1] ?? 'routes/modules/hr.php';
$out      = $argv[2] ?? preg_replace('/\.php$/', '.new.php', $in);
$ctrlDir  = 'app/Http/Controllers';
$baseNs   = 'App\\Http\\Controllers\\';

if (!is_file($in)) {
    fwrite(STDERR, "Input file not found: $in\n");
    exit(1);
}

$lines   = file($in, FILE_IGNORE_NEW_LINES);
$nsStack = [];      // namespace segment per open group
$pfStack = [];      // prefix per open group (for duplicate detection)
$uses    = [];      // fqcn => true
$body    = [];
$seen    = [];
$dups    = [];
$unconverted = [];
$count   = 0;
$inBlock = false;

function fq(string $ctrl, array $nsStack, string $baseNs): string
{
    $ctrl   = ltrim($ctrl, '\\');
    $prefix = implode('\\', array_filter($nsStack));
    return $baseNs . ($prefix !== '' ? $prefix . '\\' : '') . $ctrl;
}

foreach ($lines as $i => $line) {
    $trim = trim($line);

    // ---- comments: copy untouched -------------------------------------
    if ($inBlock) {
        $body[] = $line;
        if (strpos($line, '*/') !== false) $inBlock = false;
        continue;
    }
    if ($i === 0 && strpos($trim, '<?php') === 0) continue;
    if (strpos($trim, '/*') === 0) {
        $body[] = $line;
        if (strpos($line, '*/') === false) $inBlock = true;
        continue;
    }
    if (strpos($trim, '//') === 0 || strpos($trim, '#') === 0) {
        $body[] = $line;
        continue;
    }

    // ---- group opening: Route::group([...], function () { -------------
    if (preg_match('/^(\s*)Route::group\(\s*\[(.*)\]\s*,\s*function\s*\(\s*\)\s*\{\s*$/', $line, $m)) {
        $indent = $m[1];
        $opts   = [];
        preg_match_all('/[\'"](prefix|namespace|middleware|as|domain)[\'"]\s*=>\s*(\[[^\]]*\]|[\'"][^\'"]*[\'"])/', $m[2], $mm, PREG_SET_ORDER);
        foreach ($mm as $o) $opts[$o[1]] = trim($o[2]);

        $ns = isset($opts['namespace']) ? trim($opts['namespace'], '\'"\\') : '';
        $pf = isset($opts['prefix'])    ? trim($opts['prefix'], '\'"')      : '';
        $nsStack[] = $ns;
        $pfStack[] = $pf;

        $chain = 'Route';
        if (isset($opts['domain']))     $chain .= '::domain(' . $opts['domain'] . ')';
        if (isset($opts['prefix']))     $chain .= ($chain === 'Route' ? '::' : '->') . 'prefix(' . $opts['prefix'] . ')';
        if (isset($opts['as']))         $chain .= ($chain === 'Route' ? '::' : '->') . 'name(' . $opts['as'] . ')';
        if (isset($opts['middleware'])) $chain .= ($chain === 'Route' ? '::' : '->') . 'middleware(' . $opts['middleware'] . ')';
        if ($chain === 'Route')         $chain = 'Route::group';
        else                            $chain .= '->group';

        $body[] = $indent . $chain . '(function () {';
        continue;
    }

    // ---- other group openers: Route::middleware(...)->group(function () {
    if (preg_match('/->group\(\s*function\s*\(\s*\)\s*\{\s*$/', $line)) {
        $nsStack[] = '';
        $pfStack[] = '';
        $line = preg_replace('/->group\(\s*function\s*\(\s*\)\s*\{/', '->group(function () {', $line);
        $body[] = $line;
        continue;
    }

    // ---- group closing -------------------------------------------------
    if (preg_match('/^\s*\}\);\s*$/', $line)) {
        array_pop($nsStack);
        array_pop($pfStack);
        $body[] = $line;
        continue;
    }

    // ---- Route::verb('uri', 'Ctrl@method') ------------------------------
    $line = preg_replace_callback(
        '/Route::(get|post|put|patch|delete|any|options)\(\s*([\'"])(.*?)\2\s*,\s*([\'"])([\w\\\\]+)@(\w+)\4\s*\)/',
        function ($m) use (&$uses, &$seen, &$dups, &$count, $nsStack, $pfStack, $baseNs, $i) {
            [$all, $verb, $q, $uri, , $ctrl, $method] = $m;
            $uri   = preg_replace('/\{\s+/', '{', $uri);
            $uri   = preg_replace('/\s+\}/', '}', $uri);
            $fqcn  = fq($ctrl, $nsStack, $baseNs);
            $uses[$fqcn] = true;
            $count++;

            $full = trim(implode('/', array_filter($pfStack, 'strlen')) . '/' . $uri, '/');
            $full = preg_replace('#/+#', '/', $full);
            $key  = strtoupper($verb) . ' ' . $full;
            if (isset($seen[$key])) $dups[] = sprintf('%-60s lines %d and %d', $key, $seen[$key], $i + 1);
            else $seen[$key] = $i + 1;

            return "Route::$verb($q$uri$q, [@@{$fqcn}@@::class, '$method'])";
        },
        $line
    );

    // ---- Route::resource('x', 'Ctrl') -----------------------------------
    $line = preg_replace_callback(
        '/Route::(resource|apiResource)\(\s*([\'"])(.*?)\2\s*,\s*([\'"])([\w\\\\]+)\4/',
        function ($m) use (&$uses, &$count, $nsStack, $baseNs) {
            $fqcn = fq($m[5], $nsStack, $baseNs);
            $uses[$fqcn] = true;
            $count++;
            return "Route::{$m[1]}({$m[2]}{$m[3]}{$m[2]}, @@{$fqcn}@@::class";
        },
        $line
    );

    if (preg_match('/Route::\w+\(.*[\'"][\w\\\\]+@\w+[\'"]/', $line)) {
        $unconverted[] = ($i + 1) . ': ' . $trim;
    }
    $body[] = $line;
}

// ---- build aliases for controllers that share a short name -------------
$byShort = [];
foreach (array_keys($uses) as $fqcn) {
    $byShort[substr($fqcn, strrpos($fqcn, '\\') + 1)][] = $fqcn;
}
$alias = []; // fqcn => name used in code
foreach ($byShort as $short => $list) {
    if (count($list) === 1) { $alias[$list[0]] = $short; continue; }
    foreach ($list as $fqcn) {
        $parts = explode('\\', substr($fqcn, strlen($baseNs)));
        array_pop($parts);                      // drop class name
        $name = $short;
        for ($n = 1; $n <= count($parts); $n++) {
            $name = implode('', array_slice($parts, -$n)) . $short;
            $clash = false;
            foreach ($list as $other) {
                if ($other !== $fqcn && isset($alias[$other]) && $alias[$other] === $name) $clash = true;
            }
            if (!$clash) break;
        }
        $alias[$fqcn] = $name;
    }
}

$useLines = [];
foreach ($alias as $fqcn => $name) {
    $short = substr($fqcn, strrpos($fqcn, '\\') + 1);
    $useLines[] = 'use ' . $fqcn . ($name !== $short ? ' as ' . $name : '') . ';';
}
sort($useLines);
$useLines[] = 'use Illuminate\\Support\\Facades\\Route;';

$text = implode("\n", $body);
$text = preg_replace_callback('/@@(.*?)@@/', fn($m) => $alias[$m[1]], $text);
$text = "<?php\n\n" . implode("\n", $useLines) . "\n\n" . ltrim($text, "\n") . "\n";

file_put_contents($out, $text);

// ---- report -------------------------------------------------------------
echo "Converted $count routes -> $out\n";
echo count($alias) . " controllers imported\n";

$missing = [];
if (is_dir($ctrlDir)) {
    foreach (array_keys($alias) as $fqcn) {
        $path = $ctrlDir . '/' . str_replace('\\', '/', substr($fqcn, strlen($baseNs))) . '.php';
        if (!is_file($path)) $missing[] = $fqcn;
    }
}
if ($missing) {
    echo "\nControllers whose file was NOT found (check spelling / letter case, Linux is case-sensitive):\n";
    foreach ($missing as $c) echo "  $c\n";
}
if ($dups) {
    echo "\nDuplicate routes (the FIRST one registered wins, the later one is dead code):\n";
    foreach ($dups as $d) echo "  $d\n";
}
if ($unconverted) {
    echo "\nLines that still look like Controller@method (convert by hand):\n";
    foreach ($unconverted as $u) echo "  $u\n";
}
