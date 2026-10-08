<?php

use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UserDashboardController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\TestXYZController;

use App\Http\Controllers\Hr\ProfileController;
use App\Http\Controllers\Hr\ReportController;
use App\Http\Controllers\Hr\Adminstrator\UserController;
use App\Http\Controllers\Hr\Recruitment\BenefitController;
use App\Http\Controllers\Hr\TimeAttendance\ShiftRoasterController;
use App\Http\Controllers\Hr\TimeAttendance\LeaveWorkerController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// --- Reboot helper ---------------------------------------------------------
Route::get('reboot', function () {
    Artisan::call('storage:link');
    Artisan::call('cache:clear');
    Artisan::call('route:clear');
    Artisan::call('view:clear');
    file_put_contents(storage_path('logs/laravel.log'), '');
    Artisan::call('key:generate');
    Artisan::call('config:cache');

    return '<center><h1>System Rebooted!</h1></center>';
});

// --- Public job endpoints --------------------------------------------------
Route::get('hr/payroll/promotion-jobs', [BenefitController::class, 'promotionJobs']);
Route::get('hr/payroll/increment-jobs', [BenefitController::class, 'incrementJobs']);

// --- Guest-only module routes (loaded outside auth) ------------------------
require __DIR__.'/modules/guest.php';

// --- Authenticated routes --------------------------------------------------
Route::middleware('auth')->group(function () {

    // Home
    Route::get('/', [HomeController::class, 'index'])->name('home');
    Route::get('/home', [HomeController::class, 'index']);
    Route::get('/clear-cache', [HomeController::class, 'clear']);

    // Reports / profile
    Route::get('/mmr-report', [ReportController::class, 'mmr']);
    Route::get('/profile', [ProfileController::class, 'showProfile']);

    // HR jobs
    Route::get('hr/timeattendance/shift-jobs',
        [ShiftRoasterController::class, 'shiftJobs']);
    Route::get('hr/leave/leave_status_jobs',
        [LeaveWorkerController::class, 'maternityLeaveCheck']);
    Route::get('hr/leave/leave_status_update_jobs',
        [LeaveWorkerController::class, 'LeaveStatusCheckAndUpdate']);

    // Search
    Route::get('/search-employee-result', [SearchController::class, 'searchEmp']);
    Route::get('/search', [SearchController::class, 'search']);
    Route::post('/search/suggestion', [SearchController::class, 'suggestion']);
    Route::get('/user-search', [UserDashboardController::class, 'userSearch']);

    // Dashboards
    Route::get('dashboard', [UserDashboardController::class, 'index'])
        ->name('user-dashboard');

    // User dashboard
    Route::post('user-dashboard/events',
        [UserDashboardController::class, 'eventSettings']);
    Route::get('user-dashboard/conversations',
        [UserDashboardController::class, 'conversations']);
    Route::get('user-dashboard/send-message',
        [UserDashboardController::class, 'sendMessage']);
    Route::get('user-dashboard/delete-message',
        [UserDashboardController::class, 'deleteMessage']);

    // Change password
    Route::get('user/change-password', [UserController::class, 'password']);
    Route::post('user/change-password', [UserController::class, 'changePassword']);

    // --- Module route files ------------------------------------------------
    require __DIR__.'/modules/pms.php';
    require __DIR__.'/modules/my_project.php';
    require __DIR__.'/modules/hr.php';
    require __DIR__.'/modules/merchandising.php';
    require __DIR__.'/modules/accounting.php';
});

// --- Test route ------------------------------------------------------------
Route::get('test-check', [TestXYZController::class, 'rfidUpdate']);
