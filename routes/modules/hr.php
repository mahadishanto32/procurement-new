<?php

use App\Http\Controllers\Audit\Hr\EndOfJobAuditController;
use App\Http\Controllers\Audit\Hr\MaternityAuditController;
use App\Http\Controllers\DistrictUpazillaController;
use App\Http\Controllers\EducationController;
use App\Http\Controllers\Hr\Adminstrator\RolesController;
use App\Http\Controllers\Hr\Adminstrator\UserController;
use App\Http\Controllers\Hr\AnalyticsController as HrAnalyticsController;
use App\Http\Controllers\Hr\Assets\AssetController;
use App\Http\Controllers\Hr\AttArchiveController;
use App\Http\Controllers\Hr\BuyerMode\BmodeGenerateController;
use App\Http\Controllers\Hr\BuyerMode\BmodeJobCardController;
use App\Http\Controllers\Hr\BuyerMode\BmodePaySlipController;
use App\Http\Controllers\Hr\BuyerMode\BmodeSalarySheetController;
use App\Http\Controllers\Hr\Buyer\BuyerJobCardController;
use App\Http\Controllers\Hr\Buyer\BuyerModeController;
use App\Http\Controllers\Hr\Buyer\BuyerSalaryController;
use App\Http\Controllers\Hr\Common\EmployeeAttributeController;
use App\Http\Controllers\Hr\DashboardController as HrDashboardController;
use App\Http\Controllers\Hr\DatabaseBackupController;
use App\Http\Controllers\Hr\Employee\FileController;
use App\Http\Controllers\Hr\Ess\GrievanceAppealController;
use App\Http\Controllers\Hr\Ess\LeaveApplicationController;
use App\Http\Controllers\Hr\Ess\LoanApplicationController;
use App\Http\Controllers\Hr\Ess\MedicalIncidentController;
use App\Http\Controllers\Hr\Ess\OutsideRequestController;
use App\Http\Controllers\Hr\IDGenerator;
use App\Http\Controllers\Hr\LineReportController;
use App\Http\Controllers\Hr\Logs\LogController;
use App\Http\Controllers\Hr\Notification\NotifGAController;
use App\Http\Controllers\Hr\Notification\NotifLeaveController;
use App\Http\Controllers\Hr\Notification\NotifLoanController;
use App\Http\Controllers\Hr\Notification\NotifPAController;
use App\Http\Controllers\Hr\Notification\NotifTrainingController;
use App\Http\Controllers\Hr\OperationLoadEmployeeController;
use App\Http\Controllers\Hr\Operation\AbsentPresentListController;
use App\Http\Controllers\Hr\Operation\AttendanceFormController;
use App\Http\Controllers\Hr\Operation\AttendanceOperationController;
use App\Http\Controllers\Hr\Operation\AttendanceRawFileController;
use App\Http\Controllers\Hr\Operation\AttendanceRollbackController;
use App\Http\Controllers\Hr\Operation\BillOperationController;
use App\Http\Controllers\Hr\Operation\BonusController;
use App\Http\Controllers\Hr\Operation\EmployeeBonusController;
use App\Http\Controllers\Hr\Operation\HolidayDutyController;
use App\Http\Controllers\Hr\Operation\HolidayRosterController;
use App\Http\Controllers\Hr\Operation\IncentiveOperationController;
use App\Http\Controllers\Hr\Operation\JobCardController as OperationJobCardController;
use App\Http\Controllers\Hr\Operation\LocationChangeController;
use App\Http\Controllers\Hr\Operation\MaternityPaymentCOntroller;
use App\Http\Controllers\Hr\Operation\MaternityPaymentController;
use App\Http\Controllers\Hr\Operation\MultiEmpShiftAssignController;
use App\Http\Controllers\Hr\Operation\SalaryProcessController;
use App\Http\Controllers\Hr\Operation\ShiftRosterController;
use App\Http\Controllers\Hr\Operation\SubstituteHolidayController;
use App\Http\Controllers\Hr\Operation\UndeclaredEmployeeController;
use App\Http\Controllers\Hr\Operation\VoucherController;
use App\Http\Controllers\Hr\Operation\WarningNoticeController;
use App\Http\Controllers\Hr\Payroll\BankSheetController;
use App\Http\Controllers\Hr\Payroll\BenefitsCalculationController;
use App\Http\Controllers\Hr\Payroll\IncentiveBonusController;
use App\Http\Controllers\Hr\Payroll\IncrementController;
use App\Http\Controllers\Hr\Payroll\OtController;
use App\Http\Controllers\Hr\Payroll\SalaryAdjustmentController;
use App\Http\Controllers\Hr\Payroll\SalaryController;
use App\Http\Controllers\Hr\Performance\AppraisalController;
use App\Http\Controllers\Hr\Performance\AppraisalListController;
use App\Http\Controllers\Hr\Performance\DisciplinaryRecordController;
use App\Http\Controllers\Hr\ProfileController;
use App\Http\Controllers\Hr\Recruitment\AdvanceInfoController;
use App\Http\Controllers\Hr\Recruitment\BenefitController;
use App\Http\Controllers\Hr\Recruitment\CostMappingController;
use App\Http\Controllers\Hr\Recruitment\CvController;
use App\Http\Controllers\Hr\Recruitment\EmployeeBanglaController;
use App\Http\Controllers\Hr\Recruitment\EmployeeController;
use App\Http\Controllers\Hr\Recruitment\InterviewNoteController;
use App\Http\Controllers\Hr\Recruitment\JobController;
use App\Http\Controllers\Hr\Recruitment\JoiningLetterController;
use App\Http\Controllers\Hr\Recruitment\MedicalInfoController;
use App\Http\Controllers\Hr\Recruitment\RecruitController;
use App\Http\Controllers\Hr\Recruitment\WorkerController;
use App\Http\Controllers\Hr\Recruitment\WorkerExcelController;
use App\Http\Controllers\Hr\ReportController;
use App\Http\Controllers\Hr\Reports\AbsentStatusController;
use App\Http\Controllers\Hr\Reports\AnalyticsController as ReportsAnalyticsController;
use App\Http\Controllers\Hr\Reports\AttendanceReportController;
use App\Http\Controllers\Hr\Reports\BackgroundController;
use App\Http\Controllers\Hr\Reports\BillReportController;
use App\Http\Controllers\Hr\Reports\BonusSheetController;
use App\Http\Controllers\Hr\Reports\BonusSlipController;
use App\Http\Controllers\Hr\Reports\CrossAnalysisController;
use App\Http\Controllers\Hr\Reports\DailyActivityReportController;
use App\Http\Controllers\Hr\Reports\DailyOTReportController;
use App\Http\Controllers\Hr\Reports\DataAnnalysisController;
use App\Http\Controllers\Hr\Reports\DateWiseEmployeeController;
use App\Http\Controllers\Hr\Reports\EmployeeLeaveController;
use App\Http\Controllers\Hr\Reports\EmployeeReportController;
use App\Http\Controllers\Hr\Reports\EventHistoryController;
use App\Http\Controllers\Hr\Reports\FileTagController;
use App\Http\Controllers\Hr\Reports\FixedSalarySheet2Controller;
use App\Http\Controllers\Hr\Reports\FixedSalarySheetController;
use App\Http\Controllers\Hr\Reports\GroupAttendanceController;
use App\Http\Controllers\Hr\Reports\IncentiveReportController;
use App\Http\Controllers\Hr\Reports\IncrementReportController;
use App\Http\Controllers\Hr\Reports\JobApplicationController;
use App\Http\Controllers\Hr\Reports\JobCardController as ReportsJobCardController;
use App\Http\Controllers\Hr\Reports\LeaveLogController;
use App\Http\Controllers\Hr\Reports\LineWiseAttController2;
use App\Http\Controllers\Hr\Reports\LineWiseAttController;
use App\Http\Controllers\Hr\Reports\MMRController;
use App\Http\Controllers\Hr\Reports\MonthlyActivityReportController;
use App\Http\Controllers\Hr\Reports\MonthlyIncrementController;
use App\Http\Controllers\Hr\Reports\MonthlyReportController;
use App\Http\Controllers\Hr\Reports\NomineeController;
use App\Http\Controllers\Hr\Reports\PartialSalarySheetController;
use App\Http\Controllers\Hr\Reports\PayslipController;
use App\Http\Controllers\Hr\Reports\SalaryReportController;
use App\Http\Controllers\Hr\Reports\SalarySheetController;
use App\Http\Controllers\Hr\Reports\SalarySheetCustomController;
use App\Http\Controllers\Hr\Reports\SalarySheetGenerateController;
use App\Http\Controllers\Hr\Reports\SummaryReportController;
use App\Http\Controllers\Hr\Reports\UnitReportsController;
use App\Http\Controllers\Hr\Reports\earnLeaveController;
use App\Http\Controllers\Hr\Reports\extraOtSheetController;
use App\Http\Controllers\Hr\Reports\manualAttendanceReportController;
use App\Http\Controllers\Hr\Reports\unitAttendanceController;
use App\Http\Controllers\Hr\Reports\workerRegisterController;
use App\Http\Controllers\Hr\Search\AllEmployeeSearchController;
use App\Http\Controllers\Hr\Search\AttendaceSearchController;
use App\Http\Controllers\Hr\Search\EmployeeStatusSearchController;
use App\Http\Controllers\Hr\Search\LeaveSearchController;
use App\Http\Controllers\Hr\Search\LineSearchController;
use App\Http\Controllers\Hr\Search\OTSearchController;
use App\Http\Controllers\Hr\Search\OutsideSearchController;
use App\Http\Controllers\Hr\Search\SalaryIncreaseDecreaseSearchContorller;
use App\Http\Controllers\Hr\Search\SalaryRatioSearchController;
use App\Http\Controllers\Hr\Search\SalarySearchController;
use App\Http\Controllers\Hr\Search\SearchController;
use App\Http\Controllers\Hr\ServiceBook\ServiceBookController;
use App\Http\Controllers\Hr\Settings\UnitController as SettingsUnitController;
use App\Http\Controllers\Hr\Setup\AttendanceBonusConfigController;
use App\Http\Controllers\Hr\Setup\AttendanceBonusController;
use App\Http\Controllers\Hr\Setup\BillAnnounceSettingController;
use App\Http\Controllers\Hr\Setup\BillTypeController;
use App\Http\Controllers\Hr\Setup\BonusTypeController;
use App\Http\Controllers\Hr\Setup\BuyerModeSetupController;
use App\Http\Controllers\Hr\Setup\DepartmentController;
use App\Http\Controllers\Hr\Setup\DesignationController;
use App\Http\Controllers\Hr\Setup\EanrLeaveConfigController;
use App\Http\Controllers\Hr\Setup\EducationLevelController;
use App\Http\Controllers\Hr\Setup\FloorController;
use App\Http\Controllers\Hr\Setup\HrLateCountController;
use App\Http\Controllers\Hr\Setup\HrLateCountCustomizeController;
use App\Http\Controllers\Hr\Setup\IncrementTypeController;
use App\Http\Controllers\Hr\Setup\LineController;
use App\Http\Controllers\Hr\Setup\LoanTypeController;
use App\Http\Controllers\Hr\Setup\LocationController;
use App\Http\Controllers\Hr\Setup\OtherBenefitController;
use App\Http\Controllers\Hr\Setup\RetirementPolicyContorller;
use App\Http\Controllers\Hr\Setup\SalaryStructureController;
use App\Http\Controllers\Hr\Setup\SectionController;
use App\Http\Controllers\Hr\Setup\ShiftController;
use App\Http\Controllers\Hr\Setup\ShiftRoasterDefineCOntroller;
use App\Http\Controllers\Hr\Setup\SubsectionController;
use App\Http\Controllers\Hr\Setup\SystemSettingController;
use App\Http\Controllers\Hr\Setup\UnitController as SetupUnitController;
use App\Http\Controllers\Hr\ShiftRoaster\ShiftRoasterController as ShiftRoasterShiftRoasterController;
use App\Http\Controllers\Hr\TimeAttendance\AllLeavesController;
use App\Http\Controllers\Hr\TimeAttendance\AttendaceBulkManualController;
use App\Http\Controllers\Hr\TimeAttendance\AttendaceDaywiseManualController;
use App\Http\Controllers\Hr\TimeAttendance\AttendaceManualController;
use App\Http\Controllers\Hr\TimeAttendance\AttendanceController;
use App\Http\Controllers\Hr\TimeAttendance\AttendanceExcelController;
use App\Http\Controllers\Hr\TimeAttendance\AttendanceFileProcessController;
use App\Http\Controllers\Hr\TimeAttendance\FridayShiftController;
use App\Http\Controllers\Hr\TimeAttendance\HolidayPlannerController;
use app\Http\Controllers\Hr\TimeAttendance\LeaveWorkerController;
use App\Http\Controllers\Hr\TimeAttendance\RawPunchController;
use App\Http\Controllers\Hr\TimeAttendance\ShiftRoasterController as TimeAttendanceShiftRoasterController;
use App\Http\Controllers\Hr\TimeAttendance\StationController;
use App\Http\Controllers\Hr\TimeAttendance\WithoutPayController;
use App\Http\Controllers\Hr\TimeAttendance\YearlyHolidayController;
use App\Http\Controllers\Hr\Training\TrainingAssignController;
use App\Http\Controllers\Hr\Training\TrainingController;
use App\Http\Controllers\TestController;
use Illuminate\Support\Facades\Route;

Route::prefix('hr')->group(function () {
	Route::get('/', [HrDashboardController::class, 'index']);


	// Administrator
	Route::prefix('adminstrator')->group(function () {
		Route::get('users', [UserController::class, 'index']);
		Route::post('user/list', [UserController::class, 'getUserList']);
		Route::get('user/create', [UserController::class, 'create']);

		Route::get('get_emp_as_pic', [UserController::class, 'getEmpAsPic']);
		Route::post('user/store', [UserController::class, 'store']);
		Route::get('user/edit/{id}', [UserController::class, 'edit']);
		Route::post('user/update/{id}', [UserController::class, 'update']);
		Route::get('user/delete/{id}', [UserController::class, 'destroy']);
		Route::get('user/permission-assign', [UserController::class, 'permissionAssign']);
		Route::get('user/get-permission', [UserController::class, 'getPermission']);
		Route::get('user/sync-permission', [UserController::class, 'syncPermission']);

		Route::get('employee/search', [UserController::class, 'employeeSearch']);
		Route::get('all-employee/search', [UserController::class, 'allEmployeeSearch']);
		Route::get('employee/female-associates', [UserController::class, 'femaleSearch']);
		Route::get('user/search', [UserController::class, 'userSearch']);

		Route::get('roles', [RolesController::class, 'index']);
		Route::get('role/create', [RolesController::class, 'create']);
		Route::post('role/store', [RolesController::class, 'store']);
		Route::get('role/edit/{id}', [RolesController::class, 'edit']);
		Route::post('role/edit/{id}', [RolesController::class, 'update']);
		Route::get('role/delete/{id}', [RolesController::class, 'destroy']);
		Route::get('role/sync-permission', [RolesController::class, 'syncPermission']);
	});

	// settings
	Route::prefix('settings')->group(function () {
		# unit settings
		Route::get('unit', [SettingsUnitController::class, 'index']);
		Route::post('unit', [SettingsUnitController::class, 'store']);
	});

	Route::prefix('recruitment')->group(function () {
		Route::resource('recruit', RecruitController::class);
		Route::post('recruit/{id}/update', [RecruitController::class, 'update']);

		Route::get('recruit-bulk-upload', [RecruitController::class, 'bulk']);
		Route::get('recruit-data-list', [RecruitController::class, 'list']);
		Route::post('first-step-recruitment', [RecruitController::class, 'basicRecruitStore']);
		Route::post('second-step-recruitment', [RecruitController::class, 'medicalRecruitStore']);
		Route::post('update-step-recruitment/{type}', [RecruitController::class, 'recruitUpdate']);
	});

	// common routes
	Route::get('employee-type-wise-designation/{id}', [EmployeeAttributeController::class, 'getDesignation']);
	Route::get('area-wise-department/{id}', [EmployeeAttributeController::class, 'getDepartment']);
	Route::get('department-wise-section/{id}', [EmployeeAttributeController::class, 'getSection']);
	Route::get('section-wise-subsection/{id}', [EmployeeAttributeController::class, 'getSubSection']);
});

Route::get('menu-change', [HrDashboardController::class, 'menu']);

Route::get('hr/buyermode/generate_buyer_mode', [BmodeGenerateController::class, 'generateBuyerMode']);
Route::post('hr/buyermode/generate_buyer_mode_data', [BmodeGenerateController::class, 'generateBuyerModeData']);
Route::get('hr/buyermode/get_employees', [BmodeGenerateController::class, 'getEmployees']);

// employee show
Route::get('hr/recruitment/employee/show/{associate_id?}', [EmployeeController::class, 'show']);
Route::get('hr/user-dashboard', [HrDashboardController::class, 'userDashboard']);
Route::post('hr/user-dashboard/events', [HrDashboardController::class, 'eventSettings']);
Route::get('hr/user/pdf', [ProfileController::class, 'employeeProfile']);
Route::get('hr/user/attendance_calendar/{as_id}', [ProfileController::class, 'attendanceCalendar']);
Route::post('hr/employee-status-update', [EmployeeController::class, 'statusUpdate']);

Route::get('hr/get-associates-by', [EmployeeController::class, 'getAssociateBy']);

Route::get('hr/associate-info', [LocationChangeController::class, 'getUnit']);

Route::get('hr/reports/salary-sheet-custom-individual-search', [SalarySheetCustomController::class, 'individualSearch']);
Route::get('hr/reports/salary-sheet-custom-individual-search-buyer', [BmodeSalarySheetController::class, 'individualSearch']);

Route::get('hr/over-time-report-chart', [HrDashboardController::class, 'overTimeChart']);
Route::get('hr/unit-wise-employee-summary', [HrDashboardController::class, 'unitWiseEmpSummary']);
Route::get('hr/attendance-chart', [HrDashboardController::class, 'attendanceChart']);

//---------Time and Attendance-----------//

Route::prefix('hr/search/')->middleware(['permission:Query'])->group(function () {

	Route::get('/', [SearchController::class, 'hrSearch']);

	// attendance
	Route::get('hr_att_search', [AttendaceSearchController::class, 'hrAttSearch']);
	Route::get('hr_att_search_unit', [AttendaceSearchController::class, 'hrAttSearchUnit']);
	Route::get('hr_att_search_area', [AttendaceSearchController::class, 'hrAttSearchArea']);
	Route::get('hr_att_search_department', [AttendaceSearchController::class, 'hrAttSearchDepartment']);
	Route::get('hr_att_search_floor', [AttendaceSearchController::class, 'hrAttSearchFloor']);
	Route::get('hr_att_search_section', [AttendaceSearchController::class, 'hrAttSearchSection']);
	Route::get('hr_att_search_subsection', [AttendaceSearchController::class, 'hrAttSearchSubSection']);
	Route::get('hr_att_search_employee', [AttendaceSearchController::class, 'hrAttSearchEmployee']);
	Route::get('hr_att_search_allemp', [AttendaceSearchController::class, 'hrAttSearchAllEmployee']);
	Route::get('hr_att_search_allemp_data', [AttendaceSearchController::class, 'hrAttSearchAllEmpData']);
	Route::get('hr_att_search_emp_data', [AttendaceSearchController::class, 'hrAttSearchEmpData']);
	Route::get('hr_att_search_emp_count', [AttendaceSearchController::class, 'hrGetEmpAttCount']);
	Route::get('single_emp/{associate_id}/{month}', [AttendaceSearchController::class, 'hrAttSearchSingleEmpData']);

	// all employee
	Route::get('hr_all_employee_search', [AllEmployeeSearchController::class, 'hrAllEmpSearch']);
	Route::get('hr_all_employee_search_unit', [AllEmployeeSearchController::class, 'hrAllEmpSearchUnit']);
	Route::get('hr_all_employee_search_area', [AllEmployeeSearchController::class, 'hrAllEmpSearchArea']);
	Route::get('hr_all_employee_search_department', [AllEmployeeSearchController::class, 'hrAllEmpSearchDepartment']);
	Route::get('hr_all_employee_search_floor', [AllEmployeeSearchController::class, 'hrAllEmpSearchFloor']);
	Route::get('hr_all_employee_search_section', [AllEmployeeSearchController::class, 'hrAllEmpSearchSection']);
	Route::get('hr_all_employee_search_subsection', [AllEmployeeSearchController::class, 'hrAllEmpSearchSubSection']);
	Route::get('hr_all_employee_search_employee', [AllEmployeeSearchController::class, 'hrAllEmpSearchEmployee']);
	Route::get('hr_all_employee_search_allemp', [AllEmployeeSearchController::class, 'hrAllEmpSearchAllEmployee']);
	Route::get('hr_all_employee_search_allemp_data', [AllEmployeeSearchController::class, 'hrAllEmpSearchAllEmpData']);
	Route::get('hr_all_employee_search_emp_data', [AllEmployeeSearchController::class, 'hrAllEmpSearchEmpData']);
	Route::get('hr_all_employee_search_emp_count', [AllEmployeeSearchController::class, 'hrGetEmpAttCount']);
	Route::get('single_emp_all/{associate_id}/{month}', [AllEmployeeSearchController::class, 'hrAllEmpSearchSingleEmpData']);

	Route::get('hr_all_employee_search_unit_floor', [AllEmployeeSearchController::class, 'hrGetEmpUnitFloor']);
	Route::get('hr_all_employee_search_unit_line', [AllEmployeeSearchController::class, 'hrGetEmpUnitLine']);
	Route::get('hr_all_employee_search_floor_line', [AllEmployeeSearchController::class, 'hrGetEmpFloorLine']);
	Route::get('hr_all_employee_search_all_employee', [AllEmployeeSearchController::class, 'hrGetEmpAllEmployee']);
	Route::get('hr_all_employee_show_emp_data', [AllEmployeeSearchController::class, 'hrAllEmpShowEmpData']);

	// print section
	Route::get('hr_att_searchPrint', [AttendaceSearchController::class, 'hrAttSearchPrint']);
	Route::get('hr_att_search_unitPrint', [AttendaceSearchController::class, 'hrAttSearchUnitPrint']);
	Route::get('hr_att_search_areaPrint', [AttendaceSearchController::class, 'hrAttSearchAreaPrint']);
	Route::get('hr_att_search_departmentPrint', [AttendaceSearchController::class, 'hrAttSearchDepartmentPrint']);
	Route::get('hr_att_search_floorPrint', [AttendaceSearchController::class, 'hrAttSearchFloorPrint']);
	Route::get('hr_att_search_sectionPrint', [AttendaceSearchController::class, 'hrAttSearchSectionPrint']);
	Route::get('hr_att_search_subsectionPrint', [AttendaceSearchController::class, 'hrAttSearchSubSectionPrint']);

	Route::get('hr_att_emp_count', [AttendaceSearchController::class, 'hrAttEmpCount']);
	Route::get('testf', [AttendaceSearchController::class, 'testf']);

	Route::get('hr_salary_search', [SalarySearchController::class, 'hrSalarySearch']);
	Route::get('hr_salary_search_unit', [SalarySearchController::class, 'hrSalarySearchUnit']);
	Route::get('hr_salary_search_area', [SalarySearchController::class, 'hrSalarySearchArea']);
	Route::get('hr_salary_search_department', [SalarySearchController::class, 'hrSalarySearchDepartment']);
	Route::get('hr_salary_search_floor', [SalarySearchController::class, 'hrSalarySearchFloor']);
	Route::get('hr_salary_search_section', [SalarySearchController::class, 'hrSalarySearchSection']);
	Route::get('hr_salary_search_subsection', [SalarySearchController::class, 'hrSalarySearchSubscetion']);
	Route::get('hr_salary_search_employee', [SalarySearchController::class, 'hrSalarySearchEmployee']);
	Route::get('hr_salary_search_employee_info', [SalarySearchController::class, 'hrSearchEmpInfo']);
	Route::get('hr_salary_search_employee_table', [SalarySearchController::class, 'employeeTable']);
	Route::get('hr_salary_search_employee_list', [SalarySearchController::class, 'hrSalarySearchListEmployee']);

	Route::get('hr_salary_search_res', [SalarySearchController::class, 'hrSalarySearchResWise']);

	//Print
	Route::post('hr_salary_search_print_page', [SalarySearchController::class, 'hrSalarySearchPrintPage']);

	Route::get('hr_ot_search', [OTSearchController::class, 'hrOTSearch']);
	Route::get('hr_ot_search_otshift', [OTSearchController::class, 'hrOTSearchShift']);
	Route::get('hr_ot_search_othour', [OTSearchController::class, 'hrOTSearchHour']);
	Route::get('hr_ot_search_unit', [OTSearchController::class, 'hrOTSearchUnit']);
	Route::get('hr_ot_search_area', [OTSearchController::class, 'hrOTSearchArea']);
	Route::get('hr_ot_search_department', [OTSearchController::class, 'hrOTSearchDepartment']);
	Route::get('hr_ot_search_floor', [OTSearchController::class, 'hrOTSearchFloor']);
	Route::get('hr_ot_search_section', [OTSearchController::class, 'hrOTSearchSection']);
	Route::get('hr_ot_search_subsection', [OTSearchController::class, 'hrOTSearchSubscetion']);
	Route::get('hr_ot_search_employee', [OTSearchController::class, 'hrOTSearchEmployee']);
	Route::get('hr_ot_search_employee_info', [OTSearchController::class, 'hrSearchEmpInfo']);

	Route::get('hr_ot_search_employee_list', [OTSearchController::class, 'hrOtSearchListEmployee']);

	//Print
	Route::post('hr_ot_search_print_page', [OTSearchController::class, 'hrOtSearchPrintPage']);

	// Line Change Query

	Route::get('hr_line_search', [LineSearchController::class, 'hrLineSearch']);
	Route::get('hr_line_search_unit', [LineSearchController::class, 'hrLineSearchUnit']);
	Route::get('hr_line_search_floor', [LineSearchController::class, 'hrLineSearchFloor']);
	Route::get('hr_line_search_line', [LineSearchController::class, 'hrLineSearchLine']);
	Route::get('hr_line_search_employee', [LineSearchController::class, 'hrLineSearchEmployee']);

	Route::get('hr_line_search_change', [LineSearchController::class, 'hrLineSearchChange']);
	Route::get('hr_line_search_change_list', [LineSearchController::class, 'hrLineSearchListChange']);
	Route::get('hr_line_get_emp_details', [LineSearchController::class, 'employeeWiseChange']);

	Route::get('hr_Line_search_employee_list', [LineSearchController::class, 'hrLineSearchListEmployee']);

	//Print
	Route::post('hr_line_search_print_page', [LineSearchController::class, 'hrLineSearchPrintPage']);

	// leave
	Route::get('hr_leave_search', [LeaveSearchController::class, 'hrLeaveSearch']);
	Route::get('hr_leave_search_unit', [LeaveSearchController::class, 'hrLeaveSearchUnit']);
	Route::get('hr_leave_search_area', [LeaveSearchController::class, 'hrLeaveSearchArea']);
	Route::get('hr_leave_search_department', [LeaveSearchController::class, 'hrLeaveSearchDepartment']);
	Route::get('hr_leave_search_floor', [LeaveSearchController::class, 'hrLeaveSearchFloor']);
	Route::get('hr_leave_search_section', [LeaveSearchController::class, 'hrLeaveSearchSection']);
	Route::get('hr_leave_search_subsection', [LeaveSearchController::class, 'hrLeaveSearchSubSection']);
	Route::get('hr_leave_search_employee', [LeaveSearchController::class, 'hrLeaveSearchEmployee']);
	Route::get('hr_leave_search_allemp', [LeaveSearchController::class, 'hrLeaveSearchAllEmployee']);
	Route::get('hr_leave_search_allemp_data', [LeaveSearchController::class, 'hrLeaveSearchAllEmpData']);
	Route::get('hr_leave_search_emp_data', [LeaveSearchController::class, 'hrLeaveSearchEmpData']);
	Route::get('hr_leave_search_emp_count', [LeaveSearchController::class, 'hrGetEmpAttCount']);
	Route::get('leave_single_emp/{associate_id}/{month}', [LeaveSearchController::class, 'hrLeaveSearchSingleEmpData']);
	// print section
	Route::get('hr_leave_searchPrint', [LeaveSearchController::class, 'hrLeaveSearchPrint']);
	Route::post('hr_leave_search_unitPrint', [LeaveSearchController::class, 'hrLeaveSearchUnitPrint']);
	Route::post('hr_leave_search_areaPrint', [LeaveSearchController::class, 'hrLeaveSearchAreaPrint']);
	Route::post('hr_leave_search_departmentPrint', [LeaveSearchController::class, 'hrLeaveSearchDepartmentPrint']);
	Route::post('hr_leave_search_floorPrint', [LeaveSearchController::class, 'hrLeaveSearchFloorPrint']);
	Route::post('hr_leave_search_sectionPrint', [LeaveSearchController::class, 'hrLeaveSearchSectionPrint']);
	Route::post('hr_leave_search_subsectionPrint', [LeaveSearchController::class, 'hrLeaveSearchSubSectionPrint']);

	// outside
	Route::get('hr_outside_search', [OutsideSearchController::class, 'hrOutsideSearch']);
	Route::get('hr_outside_search_employee', [OutsideSearchController::class, 'hrOutsideSearchEmployee']);

	Route::get('hr_outside_search_emp_data', [OutsideSearchController::class, 'hrOutsideSearchEmpData']);
	Route::get('hr_outside_search_emp_date_datalist', [OutsideSearchController::class, 'hrOutsideSearchEmpDateDataList']);
	Route::get('hr_outside_get_emp_details', [OutsideSearchController::class, 'hrOutsideGetEmpDetails']);
	// print section
	Route::get('hr_outside_searchPrint', [OutsideSearchController::class, 'hrOutsideSearchPrint']);

	//salary ratio
	Route::get('hr_salratio_search', [SalaryRatioSearchController::class, 'hrSalRatioSearch']);
	// print section
	Route::get('hr_salratio_searchPrint', [SalaryRatioSearchController::class, 'hrSalRatioSearchPrint']);

	// employee status
	Route::get('hr_empstatus_search', [EmployeeStatusSearchController::class, 'hrEmpstatusSearch']);
	Route::get('hr_empstatus_search_employee', [EmployeeStatusSearchController::class, 'hrEmpstatusSearchEmployee']);
	Route::get('hr_empstatus_search_emp_data', [EmployeeStatusSearchController::class, 'hrEmpstatusSearchEmpData']);
	Route::get('hr_empstatus_search_join_employee', [EmployeeStatusSearchController::class, 'hrEmpstatusSearchEmpJoinData']);
	Route::get('hr_empstatus_search_unit', [EmployeeStatusSearchController::class, 'hrAllUnit']);
	Route::get('hr_empstatus_search_unit_emp_list', [EmployeeStatusSearchController::class, 'hrUnitEmployeeList']);
	Route::get('hr_empstatus_search_unit_emp_data', [EmployeeStatusSearchController::class, 'hrUnitEmpData']);
	// print section
	Route::get('hr_empstatus_searchPrint', [EmployeeStatusSearchController::class, 'hrEmpstatusSearchPrint']);

	//Salary Increase Decrease..
	Route::get('hr_salincdec_search', [SalaryIncreaseDecreaseSearchContorller::class, 'hrSalIncDecSearch']);

});


// attendance
Route::get('hr/timeattendance/daily_attendance_list', [AttendanceController::class, 'dailyAttendance']);
Route::get('hr/timeattendance/daily_attendance_data', [AttendanceController::class, 'getAttendanceData']);

Route::get('hr/timeattendance/attendance-upload', [AttendaceManualController::class, 'showForm'])->middleware(['permission:Attendance Upload']);
Route::post('hr/timeattendance/attendance_manual', [AttendaceManualController::class, 'saveData'])->middleware(['permission:Attendance Upload']);

Route::get('hr/timeattendance/default-punch', [AttendaceManualController::class, 'defaultPunch'])->middleware(['permission:Default Punch']);
Route::post('hr/timeattendance/default-punch', [AttendaceManualController::class, 'storeDefaultPunch'])->middleware(['permission:Default Punch']);
Route::get('hr/timeattendance/employee_by_fields', [AttendaceManualController::class, 'employeeByField']);

Route::get('/hr/timeattendance/attendance_process_wise', [AttendanceExcelController::class, 'importFileProcess']);
Route::get('hr/timeattendance/attendance_bulk_manual', [AttendaceBulkManualController::class, 'bulkManual']);
Route::post('hr/timeattendance/attendance_bulk_store', [AttendaceBulkManualController::class, 'bulkManualStore']);

// attendance raw file process
Route::get('hr/operation/attendance-raw-file', [AttendanceRawFileController::class, 'index']);
Route::post('hr/operation/attendance-raw-file', [AttendanceRawFileController::class, 'store']);

Route::get('hr/operation/undeclared-employee', [UndeclaredEmployeeController::class, 'index']);
Route::get('hr/operation/undeclared-employee-data', [UndeclaredEmployeeController::class, 'getData']);
Route::post('hr/operation/undeclared-employee-operation', [HolidayRosterController::class, 'undecrlarEmployee']);

//attendance new process
Route::post('/hr/timeattendance/attendance_manual/import', [AttendanceFileProcessController::class, 'importFile']);
// Route::post('/hr/timeattendance/attendance_process_wise_data', 'Hr\TimeAttendance\AttendanceFileProcessController@attendanceProcess');
Route::post('/hr/timeattendance/attendance_process_wise_data', [AttendanceFileProcessController::class, 'attFileProcess']);
//attendance absent
Route::get('hr/timeattendance/unit-wise-absent', [AttendanceFileProcessController::class, 'unitAbsent']);

Route::get('hr/timeattendance/daywise_manual_attendance', [AttendaceDaywiseManualController::class, 'dayManual']);
Route::get('hr/timeattendance/daywise_manual_attendance_process', [AttendaceDaywiseManualController::class, 'dayManualProcess']);
Route::get('hr/attendance/floor_by_unit', [AttendaceDaywiseManualController::class, 'getFloorByUnit']);

// test manual attendance
Route::get('hr/timeattendance/daywise_manual_attendance_test', [AttendaceDaywiseManualController::class, 'dayManualTest']);
Route::get('hr/timeattendance/daywise_manual_attendance_test_data', [AttendaceDaywiseManualController::class, 'dayManualTestData']);

////
Route::post('hr/timeattendance/attendance_daywise_store', [AttendaceDaywiseManualController::class, 'dayManualStore']);

//Process Button route for manual attendance update from temporary table(File upload)
Route::get('hr/timeattendance/temporary_data_process/{id}', [AttendanceExcelController::class, 'processAttendance']);

Route::get('hr/timeattendance/existing_punch', [AttendaceManualController::class, 'getExistingPunch']);

Route::get('hr/timeattendance/manual_att_log', [AttendaceManualController::class, 'manualAttLog']);
Route::get('hr/timeattendance/manual_att_log_data', [AttendaceManualController::class, 'manualAttLogData']);
Route::get('hr/timeattendance/calculate_ot', [AttendaceManualController::class, 'calculateOt']);

// activity lock/unlock check
Route::get('hr/operation/unit-wise-activity-lock', [AttendanceOperationController::class, 'activityLock']);

//Attendance Form
Route::get('hr/operation/attendance-form', [AttendanceFormController::class, 'index'])->middleware(['permission:Attendance Operation']);

Route::get('hr/operation/attendance-form/report', [AttendanceFormController::class, 'report'])->middleware(['permission:Attendance Operation']);


//Attendance Report
Route::get('hr/operation/attendance-operation', [AttendanceController::class, 'attendanceReport'])->middleware(['permission:Attendance Operation']);


// Route::get('hr/timeattendance/attendance_report_data', 'Hr\TimeAttendance\AttendanceController@attendanceReportData')->middleware(['permission:Attendance Operation']);
Route::get('hr/timeattendance/attendance_report_data', [AttendanceOperationController::class, 'attendanceReportData'])->middleware(['permission:Attendance Operation']);
Route::get('hr/timeattendance/attendance_summary', [AttendanceController::class, 'attendanceSummary']);
Route::get('hr/attendance/save_from_report', [AttendanceController::class, 'saveFromReport']);
Route::get('hr/attendance/save_from_report_absent', [AttendanceController::class, 'saveFromReportAbsent']);

Route::get('hr/timeattendance/make_absent', [AttendanceController::class, 'makeAbsent']);
Route::get('hr/timeattendance/make_halfday', [AttendanceController::class, 'makeHalfday']);

//shift roaster

Route::get('hr/reports/shift_roaster', [TimeAttendanceShiftRoasterController::class, 'getRoaster']);
Route::post('hr/timeattendance/shift_roaster_datatable', [TimeAttendanceShiftRoasterController::class, 'getRoasterDatatableData']);

Route::post('hr/timeattendance/shift_roaster_data', [TimeAttendanceShiftRoasterController::class, 'getRoasterData']);
Route::get('hr/timeattendance/get_floor_by_unit', [TimeAttendanceShiftRoasterController::class, 'getFloorByUnit']);

Route::get('hr/shift_roaster/ajax_get_sfhift_details', [ShiftController::class, 'getShiftTimes']);
//----------------------------

// Station Card
Route::get('hr/operation/unit-wise-line-floor', [StationController::class, 'getLineFloor']);
Route::get('hr/operation/date-wise-line-floor', [StationController::class, 'dateLineFloor']);
Route::get('hr/operation/line-change-get-employee', [StationController::class, 'lineGetEmployee']);
Route::post('hr/operation/ajax-line-changes', [StationController::class, 'ajaxLineChange']);
Route::get("hr/timeattendance/station_card", [StationController::class, 'showList']);
Route::get("hr/timeattendance/station_card_data", [StationController::class, 'listData']);
Route::get("hr/operation/line-change", [StationController::class, 'showForm'])->middleware(['permission:Station Card']);
Route::post("hr/operation/line-change", [StationController::class, 'saveForm'])->middleware(['permission:Station Card']);

Route::get("hr/timeattendance/station_card/{id}/delete", [StationController::class, 'stationDelete']);
Route::get("hr/timeattendance/station_card/{id}/edit", [StationController::class, 'stationEdit']);

Route::post("hr/timeattendance/station_card_update", [StationController::class, 'stationUpdate']);

Route::get("hr/timeattendance/station_as_info", [StationController::class, 'stationAssInfo']);
Route::get("hr/timeattendance/station_line_info", [StationController::class, 'stationLineInfo']);

//station card multiple
Route::get("hr/timeattendance/new_card/multiple_emp_for_unit", [StationController::class, 'unitEmployees']);
Route::get("hr/timeattendance/new_card/floor_for_unit", [StationController::class, 'getFloor']);
Route::get("hr/timeattendance/station_multiple_as_info", [StationController::class, 'multipleAsInfo']);
Route::post("hr/operation/line-change-multiple", [StationController::class, 'saveFormMultiple']);
Route::post("hr/operation/line-change-single", [StationController::class, 'saveFormSingle']);
// line change report
Route::get('hr/reports/line-changes', [StationController::class, 'listOf']);
Route::get('hr/reports/line-changes-data', [StationController::class, 'listOfData']);
Route::post('hr/operation/line-change-close', [StationController::class, 'updateLine']);
//shift assign
Route::get('hr/operation/shift_assign', [TimeAttendanceShiftRoasterController::class, 'shiftAssign'])->middleware(['permission:Shift Assign']);
Route::post('hr/timeattendance/shift_assign', [TimeAttendanceShiftRoasterController::class, 'saveAssignedShift'])->middleware(['permission:Shift Assign']);
Route::post('hr/timeattendance/shift_assign_processing', [TimeAttendanceShiftRoasterController::class, 'assignShiftProcessing']);
Route::get('hr/timeattendance/unitshift', [TimeAttendanceShiftRoasterController::class, 'unitShift']);
Route::get('hr/timeattendance/sectionSubsection', [TimeAttendanceShiftRoasterController::class, 'sectionSubsection']);
Route::get('hr/timeattendance/areaDepartment', [TimeAttendanceShiftRoasterController::class, 'areaDepartment']);
Route::get('hr/timeattendance/departmentSection', [TimeAttendanceShiftRoasterController::class, 'departmentSection']);

Route::get('hr/timeattendance/shifttable', [TimeAttendanceShiftRoasterController::class, 'shiftTable']);
Route::get('hr/timeattendance/get_associate_by_type_unit_shift', [TimeAttendanceShiftRoasterController::class, 'getAssociateByTypeUnitShift']);
Route::get('hr/timeattendance/get_associate_by_type_unit_shift_roster_ajax', [TimeAttendanceShiftRoasterController::class, 'getAssociateByTypeUnitShiftRosterAjax']);
Route::get('hr/operation/shift_assign_date_wise_employee', [OperationLoadEmployeeController::class, 'getShiftEmployee']);
Route::get('hr/operation/holiday_roster_assign_employee', [OperationLoadEmployeeController::class, 'getHolidayRosterEmployee']);
//leave list
Route::get('hr/timeattendance/all_leaves', [AllLeavesController::class, 'allLeaves'])->middleware(['permission:Leave List']);
Route::post('hr/timeattendance/all_leaves_data', [AllLeavesController::class, 'allLeavesData'])->middleware(['permission:Leave List']);
Route::get('hr/timeattendance/leave_edit/{id}', [AllLeavesController::class, 'editLeave'])->middleware(['permission:Manage Leave']);
Route::post('hr/timeattendance/leave_update', [AllLeavesController::class, 'updateLeave'])->middleware(['permission:Manage Leave']);
Route::get('hr/timeattendance/leave_delete/{id}', [AllLeavesController::class, 'deleteLeave'])->middleware(['permission:Manage Leave']);
Route::get('hr/timeattendance/leave_approve/{id}', [AllLeavesController::class, 'leaveView'])->middleware(['permission:Leave Approve']);
Route::post('hr/timeattendance/leave_approve/approve_reject', [AllLeavesController::class, 'leaveStatus'])->middleware(['permission:Leave Approve']);
// shift roster assign section
Route::post('/hr/operation/shift_roster_assign_action', [ShiftRosterController::class, 'assignMulti']);
Route::post('hr/operation/single-date-shift-change', [ShiftRosterController::class, 'singleDateAssign']);

// holiday roster
Route::resource('hr/operation/holiday-roster', HolidayRosterController::class)->middleware(['permission:Holiday Roster']);
Route::get('hr/operation/holiday-roster-list', [HolidayRosterController::class, 'list'])->middleware(['permission:Holiday Roster']);
Route::get('hr/operation/holiday-roster-delete/{id}', [HolidayRosterController::class, 'destroy'])->middleware(['permission:Holiday Roster']);
// shift Roaster

Route::get('hr/reports/holiday-roster', [ShiftRoasterShiftRoasterController::class, 'viewRoaster'])->middleware(['permission:Holiday Roster']);
Route::post('hr/shift_roaster/save_roaster', [ShiftRoasterShiftRoasterController::class, 'saveRoaster'])->middleware(['permission:Holiday Roster']);
Route::get('hr/shift_roaster/roaster_view_data', [ShiftRoasterShiftRoasterController::class, 'getRoasterData']);
Route::get('hr/shift_roaster/roaster_save_changes', [ShiftRoasterShiftRoasterController::class, 'roasterSaveChanges']);
Route::get('hr/shift_roaster/roaster_updated_changes', [ShiftRoasterShiftRoasterController::class, 'roasterUpdatedChanges']);



//Leave approval for worker
Route::prefix('hr/timeattendance/')->middleware(['permission:Manage Leave'])->group(function () {

	Route::get('leave-entry', [LeaveWorkerController::class, 'showForm']);
	Route::post('get-leave-balance', [LeaveWorkerController::class, 'getLeaveBalance']);
	Route::post('split-leave-days', [LeaveWorkerController::class, 'splitDays']);
	Route::get('verify-leave', [LeaveWorkerController::class, 'getLeaveBalance']);
	Route::post('leave_worker', [LeaveWorkerController::class, 'saveData']);
	Route::get('leave_data/{id}/{type}', [LeaveWorkerController::class, 'leaveApprove']);
});

Route::get('hr/reports/maternity', [MaternityPaymentController::class, 'report']);

//Operation - Maternity Leave
Route::get('hr/operation/maternity-leave', [MaternityPaymentController::class, 'showForm']);
Route::post('hr/operation/maternity-leave', [MaternityPaymentController::class, 'leaveApplication']);
Route::get('hr/operation/maternity-leave/list', [MaternityPaymentController::class, 'index']);
Route::get('hr/operation/maternity-leave/listData', [MaternityPaymentController::class, 'listData']);
Route::get('hr/operation/maternity-leave/{id}', [MaternityPaymentController::class, 'process']);
Route::post('hr/maternity-leave/approve', [MaternityPaymentController::class, 'approve']);

Route::get('hr/operation/maternity-medical-process/{id}', [MaternityPaymentController::class, 'medicalProcess']);
Route::post('hr/operation/maternity-medical-basic/', [MaternityPaymentController::class, 'storeMedicalBasic']);
Route::post('hr/operation/maternity-medical-record/', [MaternityPaymentController::class, 'storeMedicalRecord']);

Route::get('hr/operation/maternity-leave/doctors-clearence/{id}', [MaternityPaymentController::class, 'doctorsClearance']);
Route::post('hr/operation/doctor-clearence-letter', [MaternityPaymentController::class, 'clearenceLetter']);

Route::get('hr/operation/maternity-leave-payment', [MaternityPaymentCOntroller::class, 'index'])->middleware(['permission:Maternity Payment']);
Route::get('hr/operation/get_maternity_employees', [MaternityPaymentCOntroller::class, 'getMaternityEmployees']);
Route::get('hr/operation/get_maternity_employee_details', [MaternityPaymentCOntroller::class, 'getMaternityEmployeeDetails']);
Route::get('hr/operation/save_maternity_salary_disburse', [MaternityPaymentCOntroller::class, 'saveMaternityDisburse'])->middleware(['permission:Maternity Payment']);

//Operation - Leave Approval
Route::get('hr/timeattendance/operation/leave_approval', [LeaveWorkerController::class, 'showForm'])->middleware(['permission:Leave Approve']);
Route::post('hr/timeattendance/operation/leave_approval', [LeaveWorkerController::class, 'saveData'])->middleware(['permission:Leave Approve']);

//Operation - Without Pay
Route::get('hr/timeattendance/operation/without_pay_list', [WithoutPayController::class, 'showList']);
Route::post('hr/timeattendance/operation/without_pay_list_data', [WithoutPayController::class, 'getData']);
Route::get('hr/timeattendance/operation/without_pay', [WithoutPayController::class, 'showForm']);
Route::post('hr/timeattendance/operation/without_pay', [WithoutPayController::class, 'saveData']);
Route::get('hr/timeattendance/operation/without_pay_edit/{id}', [WithoutPayController::class, 'editForm']);
Route::post('hr/timeattendance/operation/without_pay_edit', [WithoutPayController::class, 'updateData']);

//Yearly Holiday Planner

Route::prefix('hr/operation/')->middleware(['permission:Yearly Holiday'])->group(function () {
	Route::resource('holiday-planner', HolidayPlannerController::class);
	Route::get('holiday-planner-list', [HolidayPlannerController::class, 'list']);
	Route::get('planner-day-wise-date', [HolidayPlannerController::class, 'getDayWiseDate']);
	Route::get('holiday-planner-delete/{id}', [HolidayPlannerController::class, 'destroy']);
});

Route::get('hr/operation/yearly_holidays', [YearlyHolidayController::class, 'index'])->middleware(['permission:Yearly Holiday']);
Route::post('hr/timeattendance/operation/yearly_holidays/data', [YearlyHolidayController::class, 'getAll'])->middleware(['permission:Yearly Holiday']);

Route::get('hr/operation/yearly-holidays/create', [YearlyHolidayController::class, 'create'])->middleware(['permission:Yearly Holiday']);

Route::post('hr/timeattendance/operation/yearly_holidays', [YearlyHolidayController::class, 'store'])->middleware(['permission:Yearly Holiday']);
Route::get('hr/timeattendance/operation/yearly_holidays/{id}/{status}', [YearlyHolidayController::class, 'status']);
Route::get('hr/timeattendance/operation/yearly_holidays/open_status', [YearlyHolidayController::class, 'openStatus']);
Route::get('hr/timeattendance/get_holidays', [YearlyHolidayController::class, 'getHolidays']);
Route::get('hr/timeattendance/operation/yearly_holidays/modal_data', [YearlyHolidayController::class, 'modalData']);
Route::get('hr/timeattendance/operation/yearly_holidays/modal_save', [YearlyHolidayController::class, 'modalSave']);
Route::get('hr/timeattendance/operation/yearly_holidays/modal_delete', [YearlyHolidayController::class, 'modalDelete']);
// operation/ salary process
Route::get('hr/operation/employee-wise-salary-sheet', [SalaryProcessController::class, 'employeeWise']);
// Route::get('hr/operation/unit-wise-salary-sheet', 'Hr\Operation\SalaryProcessController@unitWise');
Route::get('hr/operation/salary-generate', [SalaryProcessController::class, 'generate']);
Route::get('hr/reports/salary-audit-history/{id}', [SalaryProcessController::class, 'auditHistory']);

Route::get('hr/operation/unit-wise-pay-slip', [PayslipController::class, 'unitWise']);
//Raw Punch Data
Route::get('hr/timeattendance/raw_punch', [RawPunchController::class, 'rawPunch']);

// bill-announcement operation
Route::get('hr/operation/bill-announcement', [BillOperationController::class, 'index']);
Route::get('hr/operation/filter-wise-bill-announcement-sheet', [BillOperationController::class, 'filterWise']);
Route::post('hr/operation/review-bill-announcement', [BillOperationController::class, 'review']);
Route::post('hr/operation/pay-bill-announcement', [BillOperationController::class, 'pay']);
Route::get('hr/operation/pay-bill-announcement-excel', [BillOperationController::class, 'excel']);

// incentive bonus operation
Route::get('hr/operation/incentive-bonus', [IncentiveOperationController::class, 'index']);
Route::get('hr/operation/filter-wise-incentive-sheet', [IncentiveOperationController::class, 'filterWise']);
Route::post('hr/operation/review-incentive', [IncentiveOperationController::class, 'review']);
Route::post('hr/operation/pay-incentive', [IncentiveOperationController::class, 'pay']);
Route::get('hr/operation/pay-incentive-excel', [IncentiveOperationController::class, 'excel']);

// Bonus section
Route::get('hr/payroll/bonus', [BonusController::class, 'index']);

Route::get('hr/operation/bonus-process', [BonusController::class, 'process']);
Route::post('hr/operation/bonus-to-approval', [BonusController::class, 'toApproval']);
Route::get('hr/payroll/bonus-disburse', [BonusController::class, 'disburse']);
Route::get('hr/operation/unit-wise-bonus-sheet', [BonusController::class, 'bonusSheet']);
// bonus sheet approval process
Route::get('hr/payroll/bonus-sheet-process', [BonusController::class, 'approvalProcess']);
Route::get('hr/payroll/bonus-sheet-by-bonus-rule-summery', [BonusController::class, 'bonusRuleSummery']);
Route::get('hr/payroll/bonus-sheet-process-history', [BonusController::class, 'processHistory']);
Route::get('hr/operation/bonus-sheet-process-for-approval', [BonusController::class, 'approvalSheet']);
// bonus audit
Route::post('hr/operation/bonus-audit', [BonusSheetController::class, 'audit']);
// bonus reports
Route::get('hr/reports/bonus', [BonusSheetController::class, 'index']);
Route::get('hr/reports/bonus-report', [BonusSheetController::class, 'report']);
// cross analysis
Route::get('hr/reports/employee-cross-analysis', [CrossAnalysisController::class, 'index']);
Route::get('hr/reports/employee-cross-analysis-report', [CrossAnalysisController::class, 'report']);
Route::get('hr/reports/employee-cross-analysis-filter-report', [CrossAnalysisController::class, 'filterReport']);

Route::get('hr/search-type', [SearchController::class, 'type']);
Route::get('hr/type-wise-data-view', [SearchController::class, 'view']);



//---------Hr/ Payroll-----------//
Route::get('hr/payroll/bank-sheet', [BankSheetController::class, 'index']);
Route::get('hr/reports/monthly-salary-bank-report', [BankSheetController::class, 'report']);
Route::get('hr/payroll/ot', [OtController::class, 'OT']);
Route::post('hr/payroll/ot', [OtController::class, 'OtStore']);
Route::get('hr/payroll/ot_list', [OtController::class, 'otList']);
Route::get('hr/payroll/ot/{id}', [OtController::class, 'otEdit']);
Route::post('hr/payroll/ot_update', [OtController::class, 'otUpdate']);
Route::post('hr/payroll/ot_list_data', [OtController::class, 'otListData']);
Route::get('hr/payroll/benefit_list', [BenefitController::class, 'benefitList'])->middleware(['permission:Benefit List']);
Route::post('hr/payroll/benefit_list_data', [BenefitController::class, 'benefitListData'])->middleware(['permission:Benefit List']);
Route::get('hr/payroll/benefit_edit/{ben_as_id}', [BenefitController::class, 'benefitEdit']);
Route::post('hr/payroll/benefit_edit', [BenefitController::class, 'benefitUpdate']);

//new routes for benefits
Route::get('hr/payroll/benefits', [BenefitsCalculationController::class, 'index'])->middleware(['permission:End of Job Benefits']);
Route::get('hr/payroll/benefits/get_employee_details', [BenefitsCalculationController::class, 'getEmployeeDetails']);
Route::get('hr/associate-search-only-active', [BenefitsCalculationController::class, 'associtaeSearch']);
Route::get('hr/payroll/save_benefit_data', [BenefitsCalculationController::class, 'saveBenefits'])->middleware(['permission:End of Job Benefits']);
Route::get('hr/payroll/given_benefits_list', [BenefitsCalculationController::class, 'givenBenefitList'])->middleware(['permission:End of Job Benefits']);
Route::post('hr/payroll/get_given_benefit_data_list', [BenefitsCalculationController::class, 'getGivenBenefitData'])->middleware(['permission:End of Job Benefits']);

//Salary add deduct bulk upload
Route::middleware('permission:Salary Adjustment')->group(function () {
	Route::get('hr/payroll/monthly-salary-adjustment-employee', [SalaryAdjustmentController::class, 'adjustEmployee']);
	Route::get('hr/payroll/monthly-salary-adjustment', [SalaryAdjustmentController::class, 'include']);
	Route::post('hr/payroll/monthly-salary-adjustment-store', [SalaryAdjustmentController::class, 'adjustStore']);
	Route::get('hr/payroll/monthly-salary-adjustment-list', [SalaryAdjustmentController::class, 'index']);
	Route::get('hr/payroll/monthly-salary-adjustment-data', [SalaryAdjustmentController::class, 'data']);
	// Route::get('hr/payroll/salary-adjustment', 'Hr\Payroll\SalaryController@uploadFile');
	Route::get('hr/payroll/sample_file', [SalaryController::class, 'getDownload']);

	Route::post('hr/payroll/add_deduct', [SalaryController::class, 'storeFile']);
});

//Increment
Route::get('hr/payroll/increment', [IncrementController::class, 'index']);
Route::get('hr/payroll/increment-eligible', [IncrementController::class, 'getEligibleList']);
Route::get('hr/payroll/increment-eligible-filter', [IncrementController::class, 'getEligibleFilter']);
Route::get('hr/payroll/increment-employeewise', [IncrementController::class, 'getEmployeeSpecialList']);
Route::post('hr/payroll/increment-action', [IncrementController::class, 'incrementAction']);

Route::get('hr/payroll/increment-process', [IncrementController::class, 'process']);
Route::get('hr/payroll/increment-on-process', [IncrementController::class, 'viewOnApproval']);

Route::get('hr/payroll/increment-approval', [IncrementController::class, 'approval'])->middleware(['permission:Increment Approval|Increment Process']);
Route::post('hr/payroll/increment/get-approval-data', [IncrementController::class, 'getApprovalData']);
Route::post('hr/payroll/increment-action-initial', [IncrementController::class, 'incrementActionInitial']);

Route::post('hr/payroll/increment-action-approval', [IncrementController::class, 'incrementActionApproval']);

//Route::get('hr/payroll/increment', 'Hr\Recruitment\BenefitController@showIncrementForm');
Route::get('hr/payroll/increment-list', [IncrementController::class, 'incrementList']);
Route::get('hr/payroll/increment-list-data', [IncrementController::class, 'incrementListData']);
Route::get('hr/payroll/get_associate', [IncrementController::class, 'getAssociates'])->middleware(['permission:Manage Increment']);
Route::post('hr/payroll/increment', [IncrementController::class, 'storeIncrement'])->middleware(['permission:Manage Increment']);
Route::get('hr/payroll/increment_edit/{id}', [IncrementController::class, 'editIncrement'])->middleware(['permission:Manage Increment']);
Route::post('hr/payroll/increment_update', [IncrementController::class, 'updateIncrement'])->middleware(['permission:Manage Increment']);

//arear salary
Route::get('hr/payroll/arear_salary_disburse/{associate_id}', [BenefitController::class, 'arearSalaryGive']);
Route::post('hr/payroll/arear_salary_disburse/save', [BenefitController::class, 'arearSalarySave']);

//Promotion
Route::get('hr/payroll/promotion', [BenefitController::class, 'promotion']);
Route::post('hr/payroll/promotion', [BenefitController::class, 'storePromotion'])->middleware(['permission:Manage Promotion']);
Route::get('hr/payroll/promotion_edit/{id}', [BenefitController::class, 'promotionEdit'])->middleware(['permission:Manage Promotion']);
Route::post('hr/payroll/promotion_update', [BenefitController::class, 'updatePromotion'])->middleware(['permission:Manage Promotion']);
Route::get('hr/payroll/promotion-associate-search', [BenefitController::class, 'searchPromotedAssociate'])->middleware(['permission:Manage Promotion']);
Route::get('hr/payroll/promotion-associate-info', [BenefitController::class, 'promotedAssociateInfo'])->middleware(['permission:Manage Promotion']);
Route::get('hr/payroll/benefit/{associate_id}', [BenefitController::class, 'showAssociateBenefit']);
Route::post('hr/payroll/benefit-rollback', [BenefitController::class, 'empRollback']);

Route::get('hr/payroll/promotion-list', [BenefitController::class, 'promotionList']);
Route::get('hr/payroll/promotion-list-data', [BenefitController::class, 'promotionListData']);


//Salary
Route::get('hr/payroll/salary', [SalaryController::class, 'view']);
	//---------------------------Common Routes-------------------------//

// Upazilla and District
Route::get('district_wise_upazilla', [DistrictUpazillaController::class, 'districtWiseUpazilla']);
Route::get('level_wise_degree', [EducationController::class, 'levelWiseDegree']);

// ID Generator with department_id & joining_date
Route::post('id/generate', [IDGenerator::class, 'generator']);

//---------HR / Recruitment-----------//

// Employee Search
Route::get('hr/associate-search', [EmployeeController::class, 'associtaeSearch']);
Route::get('hr/single-associate-search', [EmployeeController::class, 'singleAssociateSearch']);

Route::get('hr/associate-tags', [EmployeeController::class, 'associateTags']);
Route::get('hr/associate/{associate_id?}', [EmployeeController::class, 'associtaeInfo']);

// ID CARD GENERATE
Route::middleware('permission:ID Card')->group(function () {
	Route::get('hr/recruitment/employee/idcard/', [EmployeeController::class, 'idCard']);
	Route::get('hr/recruitment/employee/idcard/filter', [EmployeeController::class, 'filterAssociate']);
	Route::get('hr/recruitment/employee/idcard/floor_list_by_unit', [EmployeeController::class, 'idCardFloorListByUnit']);
	Route::get('hr/recruitment/employee/idcard/line_list_by_unit_floor', [EmployeeController::class, 'idCardLineListByUnitFloor']);
	Route::post('hr/recruitment/employee/idcard/search', [EmployeeController::class, 'idCardSearch']);
	Route::post('hr/recruitment/employee/idcard/generate', [EmployeeController::class, 'idCardGenerate']);
});
//Employee Hierarchy
Route::get('hr/recruitment/employee/hierarchy/', [EmployeeController::class, 'hierarchy']);
Route::get('hr/recruitment/employee/hierarchy_data', [EmployeeController::class, 'getHierarchy']);

// Worker
Route::get('hr/recruitment/worker/recruit_list', [WorkerController::class, 'recruitList'])->middleware(['permission:Recruit List']);
Route::post('hr/recruitment/worker/recruit_data', [WorkerController::class, 'recruitData'])->middleware(['permission:Recruit List']);
Route::get('hr/recruitment/worker/recruit', [WorkerController::class, 'recruitForm'])->middleware(['permission:New Recruit']);
Route::get('hr/recruitment/worker/recruit_edit/{worker_id}', [WorkerController::class, 'recruitEditForm'])->middleware(['permission:New Recruit']);
Route::post('hr/recruitment/worker/recruit', [WorkerController::class, 'recruitStore'])->middleware(['permission:New Recruit']);
Route::post('hr/recruitment/worker/recruit-edit', [WorkerController::class, 'recruitEdit'])->middleware(['permission:New Recruit']);
Route::post('hr/recruitment/worker/recruit/excel/import', [WorkerExcelController::class, 'import'])->middleware(['permission:Recruit List']);

Route::middleware('permission:Medical Entry')->group(function () {
	Route::get('hr/recruitment/worker/medical_list', [WorkerController::class, 'showMedicalList']);
	Route::post('hr/recruitment/worker/medical_data', [WorkerController::class, 'medicalData']);
	Route::get('hr/recruitment/worker/medical_edit/{worker_id}', [WorkerController::class, 'editMedical']);
	Route::post('hr/recruitment/worker/medical', [WorkerController::class, 'medicalStore']);
});

Route::middleware('permission:IE Entry')->group(function () {
	Route::get('hr/recruitment/worker/ie_skill_list', [WorkerController::class, 'showIeSkillList']);
	Route::post('hr/recruitment/worker/ie_skill_data', [WorkerController::class, 'getIeSkillData']);
	Route::get('hr/recruitment/worker/ie_skill_edit/{worker_id}', [WorkerController::class, 'editIeSkill']);
	Route::post('hr/recruitment/worker/ie_skill_test', [WorkerController::class, 'ieSkillStore']);
});

Route::get('hr/recruitment/worker/migrate/{worker_id}', [RecruitController::class, 'migrate']);
Route::get('hr/recruitment/worker/remove/{worker_id}', [RecruitController::class, 'destroy']);

// Employee
Route::middleware('permission:Employee List')->group(function () {
	Route::get('hr/employee/list', [EmployeeController::class, 'showList']);
	Route::get('hr/employee/new-employee', [EmployeeController::class, 'today']);
	Route::get('hr/recruitment/employee/today_employee_data', [EmployeeController::class, 'getTodayData']);

	Route::get('hr/employee/incomplete-list', [EmployeeController::class, 'incompleteEmployee']);
	Route::get('hr/recruitment/employee/incomplete_employee_data', [EmployeeController::class, 'getIncompleteData']);

	Route::get('hr/recruitment/employee/employee_list_details', [EmployeeController::class, 'showListDetails']);
	Route::post('hr/recruitment/employee/employee_data', [EmployeeController::class, 'getData']);
	Route::get('hr/recruitment/employee/dropdown_data', [EmployeeController::class, 'getDropdownData']);
});
//Route::post('hr/recruitment/employee/employee_data', 'Hr\Recruitment\EmployeeController@getData');

Route::middleware('permission:Manage Employee')->group(function () {
	Route::get('hr/recruitment/employee/edit/{associate_id?}', [EmployeeController::class, 'edit']);
	Route::get('hr/recruitment/employee/delete/{associate_id?}', [EmployeeController::class, 'delete']);
	Route::get('hr/recruitment/employee/add_employee', [EmployeeController::class, 'showEmployeeForm']);
	Route::post('hr/recruitment/employee/add_employee', [EmployeeController::class, 'saveEmployee']);
	Route::post('hr/recruitment/employee/update_employee', [EmployeeController::class, 'updateEmployee']);
});
Route::get('hr/recruitment/employee/pdf/{associate_id}', [EmployeeController::class, 'pdfEmployee']);

// Medical Info
Route::middleware('permission:Manage Employee|Medical Entry')->group(function () {
	Route::get('hr/recruitment/operation/medical_info', [MedicalInfoController::class, 'medicalInfo']);
	Route::post('hr/recruitment/operation/medical_info', [MedicalInfoController::class, 'medicalInfoStore']);
	Route::get('hr/recruitment/operation/medical_info_list', [MedicalInfoController::class, 'medicalInfoList']);
	Route::post('hr/recruitment/operation/medical_info_list_data', [MedicalInfoController::class, 'medicalInfoListData']);
	Route::get('hr/recruitment/operation/medical_info_edit/{med_as_id}', [MedicalInfoController::class, 'medicalInfoEdit']);
	Route::post('hr/recruitment/operation/medical_info_update', [MedicalInfoController::class, 'medicalInfoUpdate']);
});

//Advance Information
Route::middleware('permission:Manage Employee|Medical Entry|Advance Info List')->group(function () {
	Route::get('hr/recruitment/operation/advance_info', [AdvanceInfoController::class, 'advanceInfo']);
	Route::post('hr/recruitment/operation/advance_info', [AdvanceInfoController::class, 'advanceInfoStore']);
	Route::post('hr/recruitment/operation/education_info', [AdvanceInfoController::class, 'educationInfoStore']);
	Route::post('hr/recruitment/operation/education_info/update', [AdvanceInfoController::class, 'educationInfoUpdate']);
	Route::get('hr/recruitment/operation/education_info/delete/{id}/{associate}', [AdvanceInfoController::class, 'educationDelete']);

	Route::post('hr/recruitment/employee/add_employee_bn', [AdvanceInfoController::class, 'saveBengali']);
	Route::get('hr/recruitment/operation/advance_info_list', [AdvanceInfoController::class, 'advanceInfoList']);
	Route::post('hr/recruitment/operation/advance_info_list_data', [AdvanceInfoController::class, 'advanceInfoListData']);
	Route::get('hr/recruitment/operation/advance_info_edit/{emp_adv_info_as_id}', [AdvanceInfoController::class, 'advanceInfoEdit']);
	Route::post('hr/recruitment/operation/advance_info_update', [AdvanceInfoController::class, 'advanceInfoUpdate']);
	Route::get('hr/recruitment/education_history', [AdvanceInfoController::class, 'educationHistory']);
});

//Benefits
Route::middleware('permission:Manage Employee|Assign Benifit')->group(function () {
	Route::get('hr/payroll/employee-benefit', [BenefitController::class, 'benefits']);
	Route::post('hr/recruitment/operation/benefits', [BenefitController::class, 'benefitStore']);
	Route::get('hr/recruitment/get_benefit_by_id', [BenefitController::class, 'getBenefitByID']);
});
// production bonus section
Route::get('hr/operation/production-bonus', [VoucherController::class, 'productionBonus']);
Route::post('hr/operation/production-bonus', [VoucherController::class, 'storeProductionBonus']);
Route::get('hr/operation/production-bonus-list', [VoucherController::class, 'productionList']);
Route::post('hr/operation/production-bonus-list-data', [VoucherController::class, 'productionListData']);

//Job Portal
Route::get('hr/recruitment/job_portal/cv', [CvController::class, 'CV']);
Route::get('hr/recruitment/job_portal/job_posting', [JobController::class, 'JobPosting'])->middleware(['permission:Job Posting']);

Route::get('hr/recruitment/job_portal/job_posting_list', [JobController::class, 'JobPostingList'])->middleware(['permission:Job Posting List']);


Route::get('hr/recruitment/job_portal/job_posting_list/{job_po_id}/{status}', [JobController::class, 'JobPostingListStatus']);

Route::post('hr/recruitment/job_portal/job_posting_data', [JobController::class, 'JobPostingListData']);

Route::post('hr/recruitment/job_portal/job_posting', [JobController::class, 'JobPostingStore'])->middleware(['permission:Job Posting']);

Route::get('hr/recruitment/job_portal/interview_notes', [InterviewNoteController::class, 'Interview']);
Route::get('hr/recruitment/job_portal/interview_notes_list', [InterviewNoteController::class, 'InterviewList'])->middleware(['permission:Interview Notes List']);
Route::post('hr/recruitment/job_portal/interview_notes_data', [InterviewNoteController::class, 'InterviewListData'])->middleware(['permission:Interview Notes List']);
Route::get('hr/recruitment/job_portal/interview_notes_delete/{id}', [InterviewNoteController::class, 'InterviewDelete'])->middleware(['permission:Interview Notes']);
Route::post('hr/recruitment/job_portal/interview_notes', [InterviewNoteController::class, 'InterviewNoteStore'])->middleware(['permission:Interview Notes']);

// Joining Letter
Route::get('hr/recruitment/appointment-letter', [JoiningLetterController::class, 'Letter'])->middleware(['permission:Appointment Letter']);
Route::post('hr/recruitment/job_portal/joining_letter', [JoiningLetterController::class, 'LetterSave'])->middleware(['permission:Appointment Letter']);
Route::get('hr/recruitment/job_portal/pdfview/{arg}', [JoiningLetterController::class, 'pdfDownload']);

//---------HR / Training-----------//
//---------HR / Assets Management-----------//

Route::get('hr/assets/assign', [AssetController::class, 'showForm']);
Route::post('hr/assets/assign', [AssetController::class, 'saveData']);
Route::get('hr/assets/get-product-by-category-id', [AssetController::class, 'getProductByCategoryID']);
Route::get('hr/assets/get-product-by-product-id', [AssetController::class, 'getAssetByProductID']);
Route::get('hr/assets/assign_list', [AssetController::class, 'showList']);
Route::post('hr/assets/assign_data', [AssetController::class, 'getData']);
Route::get('hr/assets/assign_edit/{id}', [AssetController::class, 'editForm']);
Route::post('hr/assets/assign_edit', [AssetController::class, 'updateData']);

//---------HR / Performance-----------//

Route::get('hr/performance/operation/disciplinary_list', [DisciplinaryRecordController::class, 'showList'])->middleware(['permission:Disciplinary List']);
Route::get('hr/performance/operation/disciplinary_data', [DisciplinaryRecordController::class, 'getData'])->middleware(['permission:Disciplinary List']);

Route::middleware('permission:Disciplinary Record')->group(function () {
	Route::get('hr/performance/disciplinary-record', [DisciplinaryRecordController::class, 'showForm']);
	Route::post('hr/performance/operation/disciplinary_form', [DisciplinaryRecordController::class, 'saveData']);
	Route::get('hr/performance/operation/disciplinary_edit/{record_id}', [DisciplinaryRecordController::class, 'editForm']);
	Route::post('hr/performance/operation/disciplinary_edit', [DisciplinaryRecordController::class, 'updateData']);
});

Route::get('hr/performance/appraisal_list', [AppraisalListController::class, 'appraisalList'])->middleware(['permission:Performance List']);
Route::post('hr/performance/appraisal_list_data', [AppraisalListController::class, 'appraisalListData'])->middleware(['permission:Performance List']);
Route::middleware('permission:Performance Appraisal')->group(function () {
	Route::get('hr/performance/appraisal', [AppraisalController::class, 'showForm']);
	Route::post('hr/performance/appraisal', [AppraisalController::class, 'saveData']);
	Route::get('hr/performance/appraisal_approve/{hr_pa_as_id}', [AppraisalListController::class, 'AppraisalView']);
	Route::post('hr/performance/appraisal_approve/approve_reject', [AppraisalListController::class, 'appraisalStatus']);
});

//shift
Route::get('hr/operation/shift', [ShiftController::class, 'shift']);
Route::get('hr/operation/shift/list', [ShiftController::class, 'list']);

// shift edit
Route::middleware('permission:Shift Assign')->group(function () {
	Route::get('hr/operation/shift/{id}', [ShiftController::class, 'edit']);
	Route::post('hr/operation/shift/update-time/{id}', [ShiftController::class, 'updateShiftTime']);
	Route::post('hr/operation/shift/sync-bill/{id}', [ShiftController::class, 'syncBill']);

	Route::get('hr/operation/getshift/{id}', [ShiftController::class, 'view']);
	Route::get('hr/operation/shift_update/{hr_shift_id}', [ShiftController::class, 'shiftUpdate']);
});

Route::get('hr/setup/getShiftListByLineID', [ShiftController::class, 'getShiftListByLineID']);
Route::get('hr/setup/shift/{hr_shift_id}', [ShiftController::class, 'shiftDelete']);
Route::post('hr/setup/shift/update', [ShiftController::class, 'shiftUpdateStore']);

//---------HR / Setup-----------//

//unit
Route::middleware(['permission:Basic Setup'])->group(function () {

	Route::get('hr/setup/unit', [SetupUnitController::class, 'unit']);
	Route::post('hr/setup/unit', [SetupUnitController::class, 'unitStore']);
	Route::get('hr/setup/unit/{hr_unit_id}', [SetupUnitController::class, 'unitDelete']);
	Route::get('hr/setup/unit_update/{hr_unit_id}', [SetupUnitController::class, 'unitUpdate']);
	Route::post('hr/setup/unit_update', [SetupUnitController::class, 'unitUpdateStore']);

	//Location
	Route::get('hr/setup/location', [LocationController::class, 'location']);
	Route::post('hr/setup/location', [LocationController::class, 'locationStore']);
	Route::get('hr/setup/location/{hr_unit_id}', [LocationController::class, 'locationDelete']);
	Route::get('hr/setup/location_update/{hr_unit_id}', [LocationController::class, 'locationUpdate']);
	Route::post('hr/setup/location_update', [LocationController::class, 'locationUpdateStore']);

	// Unit wise location
	Route::get('hr/reports/location_by_unit', [LocationController::class, 'locationListUnit']);

	//floor
	Route::get('hr/setup/floor', [FloorController::class, 'floor']);
	Route::get('hr/setup/getFloorListByUnitID', [FloorController::class, 'getFloorListByUnitID']);
	Route::post('hr/setup/floor', [FloorController::class, 'floorStore']);
	Route::get('hr/setup/floor/{hr_floor_id}', [FloorController::class, 'floorDelete']);
	Route::get('hr/setup/floor_update/{hr_floor_id}', [FloorController::class, 'floorUpdate']);
	Route::post('hr/setup/floor_update', [FloorController::class, 'floorUpdateStore']);

	//line
	Route::get('hr/setup/line', [LineController::class, 'line']);
	Route::get('hr/setup/getLineListByFloorID', [LineController::class, 'getLineListByFloorID']);
	Route::post('hr/setup/line', [LineController::class, 'lineStore']);
	Route::get('hr/setup/line/{hr_line_id}', [LineController::class, 'lineDelete']);
	Route::get('hr/setup/line_update/{hr_line_id}', [LineController::class, 'lineUpdate']);
	Route::post('hr/setup/line_update', [LineController::class, 'lineUpdateStore']);

	//department
	Route::get('hr/setup/department', [DepartmentController::class, 'department']);
	Route::get('hr/setup/getDepartmentListByAreaID', [DepartmentController::class, 'getDepartmentListByAreaID']);
	Route::post('hr/setup/department', [DepartmentController::class, 'departmentStore']);
	Route::get('hr/setup/department/{hr_department_id}', [DepartmentController::class, 'departmentDelete']);
	Route::get('hr/setup/department_update/{hr_department_id}', [DepartmentController::class, 'departmentUpdate']);
	Route::post('hr/setup/department_update', [DepartmentController::class, 'departmentUpdateStore']);

	//section
	Route::get('hr/setup/section', [SectionController::class, 'section']);
	Route::get('hr/setup/getSectionListByDepartmentID', [SectionController::class, 'getSectionListByDepartmentID']);
	Route::post('hr/setup/section', [SectionController::class, 'sectionStore']);
	Route::get('hr/setup/section/{hr_section_id}', [SectionController::class, 'sectionDelete']);
	Route::get('hr/setup/section_update/{hr_section_id}', [SectionController::class, 'sectionUpdate']);
	Route::post('hr/setup/section_update', [SectionController::class, 'sectionUpdateStore']);

	//subsection
	Route::get('hr/setup/subsection', [SubsectionController::class, 'subsection']);
	Route::get('hr/setup/getSubSectionListBySectionID', [SubsectionController::class, 'getSubSectionListBySectionID']);
	Route::post('hr/setup/subsection', [SubsectionController::class, 'subsectionStore']);
	Route::get('hr/setup/subsection/{hr_subsec_id}', [SubsectionController::class, 'subsectionDelete']);
	Route::get('hr/setup/subsection_update/{hr_subsec_id}', [SubsectionController::class, 'subsectionUpdate']);
	Route::post('hr/setup/subsection_update', [SubsectionController::class, 'subsectionUpdateStore']);
});
// bill-announce-setting
Route::resource('hr/setup/bill-setting', BillAnnounceSettingController::class);
Route::get('hr/setup/bill-setting-history', [BillAnnounceSettingController::class, 'history']);
Route::resource('hr/setup/bill-type', BillTypeController::class);


Route::get('hr/setup/get_presfhit_times', [ShiftController::class, 'getPreShiftTimes']);
Route::post('hr/setup/shift_employee_update_processing', [ShiftController::class, 'shiftUpdateEmployee']);
Route::post('hr/setup/shift_roaster_employee_update_processing', [ShiftController::class, 'shiftUpdateRoasterEmployee']);

//designation
Route::middleware('permission:Designation Setup')->group(function () {
	Route::get('hr/search-designation', [DesignationController::class, 'searchDesignation']);

	Route::get('hr/setup/designation', [DesignationController::class, 'designation']);
	Route::get('hr/setup/getDesignationListByEmployeeTypeID', [DesignationController::class, 'getDesignationListByEmployeeTypeID']);
	Route::post('hr/setup/designation', [DesignationController::class, 'designationStore']);
	Route::get('hr/setup/designation/{hr_designation_id}', [DesignationController::class, 'designationDelete']);
	// Route::get('hr/setup/designation_update/{hr_designation_id}','Hr\Setup\DesignationController@designationUpdate');

	Route::post('hr/setup/designation_update', [DesignationController::class, 'designationupdateStore']);

	Route::get('hr/setup/designation_parentget', [DesignationController::class, 'parentget']);
	Route::get('hr/setup/designation_get_worker_data', [DesignationController::class, 'get_hierarchynew_data']);

	Route::get('hr/setup/designationgetdata/{id}', [DesignationController::class, 'getdata']);

	Route::get('hr/setup/designation_hierarchy', [DesignationController::class, 'hierarchynew']);
	Route::get('hr/setup/designation_tree', [DesignationController::class, 'Tree_show']);
});
Route::post('hr/hierarchy', [DesignationController::class, 'hierarchy']);

	//Loan Type
Route::middleware('permission:Basic Setup')->group(function () {
	Route::get('hr/setup/loan_type', [LoanTypeController::class, 'addloanType']);
	Route::post('hr/setup/loan_type', [LoanTypeController::class, 'storeloanType']);
	Route::get('hr/setup/loan_type/delete/{id}', [LoanTypeController::class, 'loanTypeDelete']);
	Route::get('hr/setup/loan_type/edit/{id}', [LoanTypeController::class, 'loanTypeEdit']);
	Route::post('hr/setup/loan_type_update', [LoanTypeController::class, 'updateLoanType']);
});

//Salary Structure
Route::middleware('permission:Salary Structure Setup')->group(function () {
	Route::get('hr/setup/salary_structure', [SalaryStructureController::class, 'showForm']);
	Route::post('hr/setup/salary_structure', [SalaryStructureController::class, 'save']);
});
//Education Level
Route::middleware('permission:Education Setup')->group(function () {
	Route::get('hr/setup/education_title', [EducationLevelController::class, 'showForm']);
	Route::post('hr/setup/education_title', [EducationLevelController::class, 'saveData']);
});
//Increment Type
Route::middleware('permission:Library Setup')->group(function () {
	Route::get('hr/setup/increment_type', [IncrementTypeController::class, 'showForm']);
	Route::post('hr/setup/increment_type', [IncrementTypeController::class, 'saveData']);
	Route::get('hr/setup/increment_type_edit/{id}', [IncrementTypeController::class, 'incrementTypeEdit']);
	Route::post('hr/setup/increment_type_update', [IncrementTypeController::class, 'incrementTypeUpdate']);
	Route::get('hr/setup/increment_type_delete/{id}', [IncrementTypeController::class, 'incrementTypeDelete']);

	//Add Other Benifit Item
	Route::get('hr/setup/other_benefit_item', [OtherBenefitController::class, 'otherBenefit']);
	Route::post('hr/setup/other_benefit_item', [OtherBenefitController::class, 'otherBenefitStore']);
	Route::get('hr/setup/other_benefit_delete/{id}', [OtherBenefitController::class, 'otherBenefitDelete']);

	//other Benefit
	Route::post('hr/payroll/other_benefit', [BenefitController::class, 'otherBenefitStore']);
});
//Attendance bonus
Route::get('hr/setup/attendance_bonus', [AttendanceBonusController::class, 'showForm'])->middleware(['permission:Attendance Bonus Config']);
Route::post('hr/setup/attendance_bonus_store', [AttendanceBonusController::class, 'attBonusStore'])->middleware(['permission:Attendance Bonus Config']);


//Attendance Bonus Config Setup
Route::get('hr/setup/attendancebonus', [AttendanceBonusConfigController::class, 'index'])->middleware(['permission:Attendance Bonus Config']);
Route::post('hr/setup/attendance_bonus_save', [AttendanceBonusConfigController::class, 'saveData'])->middleware(['permission:Attendance Bonus Config']);
Route::post('hr/setup/get_values', [AttendanceBonusConfigController::class, 'getData'])->middleware(['permission:Attendance Bonus Config']);


//Shift roaster define...
Route::get('hr/operation/shift_roaster_define', [ShiftRoasterDefineCOntroller::class, 'shiftRoasterDefine'])->middleware(['permission:Define Shift Roster']);
Route::get('hr/operation/get_associate_by_type_unit_shift_roaster', [ShiftRoasterDefineCOntroller::class, 'getAssociateByTypeUnitShiftRoaster']);
Route::post('hr/operation/shift_roaster_status_save', [ShiftRoasterDefineCOntroller::class, 'shiftRoasterStatusSave'])->middleware(['permission:Define Shift Roster']);

//Multiple Employee Shift Assign
Route::get('hr/operation/multiple_emp_shift_assign', [MultiEmpShiftAssignController::class, 'index'])->middleware(['permission:Employee Shift Assign']);
Route::get('hr/operation/get_shift_unit_wise', [MultiEmpShiftAssignController::class, 'getCurrentShiftsUnitWise']);
Route::get('hr/operation/get_associate_by_type_unit_for_multi_shift_assign', [MultiEmpShiftAssignController::class, 'getAssociateByTypeUnitShiftRoaster']);
Route::post('hr/operation/multi_emp_shift_status_save', [MultiEmpShiftAssignController::class, 'shiftRoasterStatusSave'])->middleware(['permission:Employee Shift Assign']);

//---------HR / Profile-----------//

//---------HR / Notification-----------//

Route::get('hr/notification/loan/loan_app_list', [NotifLoanController::class, 'ShowLoan']);
Route::get('hr/notification/loan/loan_data', [NotifLoanController::class, 'LoanData']);
Route::get('hr/notification/loan/loan_approve/{hr_la_id?}', [NotifLoanController::class, 'LoanView']);
Route::post('hr/notification/loan/loan_approve/approve_reject', [NotifLoanController::class, 'LoanStatus']);
Route::get('hr/notification/appraisal/performance_appraisal_list', [NotifPAController::class, 'AppraisalList']);
Route::get('hr/notification/appraisal/performance_appraisal_data', [NotifPAController::class, 'AppraisalData']);
Route::get('hr/notification/appraisal/appraisal_approve/{id?}', [NotifPAController::class, 'AppraisalView']);
Route::post('hr/notification/appraisal/appraisal_approve/approve_reject', [NotifPAController::class, 'AppraisalStatus']);
Route::get('hr/notification/greivance/greivance_appeal_list', [NotifGAController::class, 'greivanceAppealList']);
Route::get('hr/notification/greivance/greivance_appeal_data', [NotifGAController::class, 'greivanceAppealListData']);
Route::get('hr/notification/greivance/greivance_approve', [NotifGAController::class, 'GreivanceView']);
Route::post('hr/notification/greivance/greivance_approve', [NotifGAController::class, 'GreivanceApprove']);
Route::post('hr/notification/greivance/greivance_approve/approve_reject', [NotifGAController::class, 'DisciplinaryRecordStatus']);

Route::get('hr/notification/training/training_list', [NotifTrainingController::class, 'TrainingList']);
Route::get('hr/notification/training/training_data', [NotifTrainingController::class, 'TrainingData']);
Route::get('hr/notification/training/training_approve/{tr_as_id}', [NotifTrainingController::class, 'TrainingView']);
Route::post('hr/notification/training/training_approve/aprrove_reject', [NotifTrainingController::class, 'TrainingStatus']);
Route::get('hr/notification/leave/leave_app_list', [NotifLeaveController::class, 'LeaveList']);
Route::get('hr/notification/leave/leave_app_data', [NotifLeaveController::class, 'LeaveData']);
Route::get('hr/notification/leave/leave_approve/{hr_leave_id?}', [NotifLeaveController::class, 'LeaveView']);
Route::post('hr/notification/leave/leave_approve/approve_reject', [NotifLeaveController::class, 'LeaveStatus']);

//---------HR / Reports-----------//
//application letter
Route::get('hr/recruitment/job-application', [JobApplicationController::class, 'applicationForm']);
Route::post('hr/recruitment/job_application', [JobApplicationController::class, 'saveApplicationForm']);


//---------HR / Training-----------//

// Add Training
Route::get('hr/training/training_list', [TrainingController::class, 'trainingList'])->middleware(['permission:Training List']);
Route::get('hr/training/training_data', [TrainingController::class, 'getData'])->middleware(['permission:Training List']);

Route::get('/hr/training/training_status/{id}/{status}', [TrainingController::class, 'trainingStatus']);
Route::get('hr/training/add_training', [TrainingController::class, 'showForm'])->middleware(['permission:Add Training']);
Route::post('hr/training/add_training', [TrainingController::class, 'saveTraining'])->middleware(['permission:Add Training']);

// Assign Training
Route::get('hr/training/assign_list', [TrainingAssignController::class, 'assignList'])->middleware(['permission:Assigned Employee List']);
Route::post('hr/training/assign_data', [TrainingAssignController::class, 'getData'])->middleware(['permission:Assigned Employee List']);

Route::get('hr/training/assign_status/{id}/{status}', [TrainingAssignController::class, 'assignStatus']);
Route::get('hr/training/assign_training', [TrainingAssignController::class, 'showForm'])->middleware(['permission:Assign Training']);
Route::post('hr/training/assign_training', [TrainingAssignController::class, 'saveTraining'])->middleware(['permission:Assign Training']);

//---------HR / Assets Management-----------//

Route::get('hr/assets/assign', [AssetController::class, 'showForm']);
Route::post('hr/assets/assign', [AssetController::class, 'saveData']);
Route::get('hr/assets/get-product-by-category-id', [AssetController::class, 'getProductByCategoryID']);
Route::get('hr/assets/get-product-by-product-id', [AssetController::class, 'getAssetByProductID']);
Route::get('hr/assets/assign_list', [AssetController::class, 'showList']);
Route::post('hr/assets/assign_data', [AssetController::class, 'getData']);
Route::get('hr/assets/assign_edit/{id}', [AssetController::class, 'editForm']);
Route::post('hr/assets/assign_edit', [AssetController::class, 'updateData']);

//---------HR / Performance-----------//

Route::get('hr/performance/operation/disciplinary_list', [DisciplinaryRecordController::class, 'showList']);
Route::get('hr/performance/operation/disciplinary_data', [DisciplinaryRecordController::class, 'getData']);
Route::get('hr/performance/operation/disciplinary_form', [DisciplinaryRecordController::class, 'showForm']);
Route::post('hr/performance/operation/disciplinary_form', [DisciplinaryRecordController::class, 'saveData']);
Route::get('hr/performance/operation/disciplinary_edit/{record_id}', [DisciplinaryRecordController::class, 'editForm']);
Route::post('hr/performance/operation/disciplinary_edit', [DisciplinaryRecordController::class, 'updateData']);
Route::get('hr/performance/appraisal', [AppraisalController::class, 'showForm']);
Route::post('hr/performance/appraisal', [AppraisalController::class, 'saveData']);
Route::get('hr/performance/appraisal_list', [AppraisalListController::class, 'appraisalList']);
Route::post('hr/performance/appraisal_list_data', [AppraisalListController::class, 'appraisalListData']);
Route::get('hr/performance/appraisal_approve/{hr_pa_as_id}', [AppraisalListController::class, 'AppraisalView']);
Route::post('hr/performance/appraisal_approve/approve_reject', [AppraisalListController::class, 'appraisalStatus']);

//---------HR / Setup-----------//

//unit
Route::get('hr/setup/unit', [SetupUnitController::class, 'unit']);
Route::post('hr/setup/unit', [SetupUnitController::class, 'unitStore']);
Route::get('hr/setup/unit/{hr_unit_id}', [SetupUnitController::class, 'unitDelete']);
Route::get('hr/setup/unit_update/{hr_unit_id}', [SetupUnitController::class, 'unitUpdate']);
Route::post('hr/setup/unit_update', [SetupUnitController::class, 'unitUpdateStore']);

//Location
Route::get('hr/setup/location', [LocationController::class, 'location']);
Route::post('hr/setup/location', [LocationController::class, 'locationStore']);
Route::get('hr/setup/location/{hr_unit_id}', [LocationController::class, 'locationDelete']);
Route::get('hr/setup/location_update/{hr_unit_id}', [LocationController::class, 'locationUpdate']);
Route::post('hr/setup/location_update', [LocationController::class, 'locationUpdateStore']);

//floor
Route::get('hr/setup/floor', [FloorController::class, 'floor']);
Route::get('hr/setup/getFloorListByUnitID', [FloorController::class, 'getFloorListByUnitID']);
Route::post('hr/setup/floor', [FloorController::class, 'floorStore']);
Route::get('hr/setup/floor/{hr_floor_id}', [FloorController::class, 'floorDelete']);
Route::get('hr/setup/floor_update/{hr_floor_id}', [FloorController::class, 'floorUpdate']);
Route::post('hr/setup/floor_update', [FloorController::class, 'floorUpdateStore']);

//line
Route::get('hr/setup/line', [LineController::class, 'line']);
Route::get('hr/setup/getLineListByFloorID', [LineController::class, 'getLineListByFloorID']);
Route::post('hr/setup/line', [LineController::class, 'lineStore']);
Route::get('hr/setup/line/{hr_line_id}', [LineController::class, 'lineDelete']);
Route::get('hr/setup/line_update/{hr_line_id}', [LineController::class, 'lineUpdate']);
Route::post('hr/setup/line_update', [LineController::class, 'lineUpdateStore']);

//shift
Route::get('hr/setup/shift', [ShiftController::class, 'shift']);
Route::get('hr/setup/getShiftListByLineID', [ShiftController::class, 'getShiftListByLineID']);
Route::post('hr/setup/shift', [ShiftController::class, 'store']);
Route::get('hr/setup/shift/{hr_shift_id}', [ShiftController::class, 'shiftDelete']);
Route::get('hr/setup/shift_update/{hr_shift_id}', [ShiftController::class, 'shiftUpdate']);
Route::post('hr/setup/shift_update', [ShiftController::class, 'shiftUpdateStore']);

//department
Route::get('hr/setup/department', [DepartmentController::class, 'department']);
Route::get('hr/setup/getDepartmentListByAreaID', [DepartmentController::class, 'getDepartmentListByAreaID']);
Route::post('hr/setup/department', [DepartmentController::class, 'departmentStore']);
Route::get('hr/setup/department/{hr_department_id}', [DepartmentController::class, 'departmentDelete']);
Route::get('hr/setup/department_update/{hr_department_id}', [DepartmentController::class, 'departmentUpdate']);
Route::post('hr/setup/department_update', [DepartmentController::class, 'departmentUpdateStore']);

//section
Route::get('hr/setup/section', [SectionController::class, 'section']);
Route::get('hr/setup/getSectionListByDepartmentID', [SectionController::class, 'getSectionListByDepartmentID']);
Route::post('hr/setup/section', [SectionController::class, 'sectionStore']);
Route::get('hr/setup/section/{hr_section_id}', [SectionController::class, 'sectionDelete']);
Route::get('hr/setup/section_update/{hr_section_id}', [SectionController::class, 'sectionUpdate']);
Route::post('hr/setup/section_update', [SectionController::class, 'sectionUpdateStore']);

//subsection
Route::get('hr/setup/subsection', [SubsectionController::class, 'subsection']);
Route::get('hr/setup/getSubSectionListBySectionID', [SubsectionController::class, 'getSubSectionListBySectionID']);
Route::post('hr/setup/subsection', [SubsectionController::class, 'subsectionStore']);
Route::get('hr/setup/subsection/{hr_subsec_id}', [SubsectionController::class, 'subsectionDelete']);
Route::get('hr/setup/subsection_update/{hr_subsec_id}', [SubsectionController::class, 'subsectionUpdate']);
Route::post('hr/setup/subsection_update', [SubsectionController::class, 'subsectionUpdateStore']);

//designation
Route::get('hr/setup/designation', [DesignationController::class, 'designation']);
Route::get('hr/setup/getDesignationListByEmployeeTypeID', [DesignationController::class, 'getDesignationListByEmployeeTypeID']);
Route::post('hr/setup/designation', [DesignationController::class, 'designationStore']);
Route::get('hr/setup/designation/{hr_designation_id}', [DesignationController::class, 'designationDelete']);
// Route::get('hr/setup/designation_update/{hr_designation_id}','Hr\Setup\DesignationController@designationUpdate');
// Route::post('hr/setup/designation_update','Hr\Setup\DesignationController@designationupdateStore');
Route::post('hr/hierarchy', [DesignationController::class, 'hierarchy']);

//Loan Type
Route::get('hr/setup/loan_type', [LoanTypeController::class, 'addloanType']);
Route::post('hr/setup/loan_type', [LoanTypeController::class, 'storeloanType']);
Route::get('hr/setup/loan_type/delete/{id}', [LoanTypeController::class, 'loanTypeDelete']);
Route::get('hr/setup/loan_type/edit/{id}', [LoanTypeController::class, 'loanTypeEdit']);
Route::post('hr/setup/loan_type_update', [LoanTypeController::class, 'updateLoanType']);

//Salary Structure
Route::get('hr/setup/salary_structure', [SalaryStructureController::class, 'showForm']);
Route::post('hr/setup/salary_structure', [SalaryStructureController::class, 'save']);

//Education Level
Route::get('hr/setup/education_title', [EducationLevelController::class, 'showForm']);
Route::post('hr/setup/education_title', [EducationLevelController::class, 'saveData']);
Route::get('hr/setup/education_title/delete/{id}', [EducationLevelController::class, 'degreeDelete']);
Route::get('hr/setup/education_title/edit/{id}', [EducationLevelController::class, 'degreeEdit']);
Route::post('hr/setup/education_title_update', [EducationLevelController::class, 'degreeUpdate']);

//Increment Type
Route::get('hr/setup/increment_type', [IncrementTypeController::class, 'showForm']);
Route::post('hr/setup/increment_type', [IncrementTypeController::class, 'saveData']);
Route::get('hr/setup/increment_type_edit/{id}', [IncrementTypeController::class, 'incrementTypeEdit']);
Route::post('hr/setup/increment_type_update', [IncrementTypeController::class, 'incrementTypeUpdate']);
Route::get('hr/setup/increment_type_delete/{id}', [IncrementTypeController::class, 'incrementTypeDelete']);

//Add Other Benifit Item
Route::get('hr/setup/other_benefit_item', [OtherBenefitController::class, 'otherBenefit']);
Route::post('hr/setup/other_benefit_item', [OtherBenefitController::class, 'otherBenefitStore']);
Route::get('hr/setup/other_benefit_delete/{id}', [OtherBenefitController::class, 'otherBenefitDelete']);

//other Benefit
Route::post('hr/payroll/other_benefit', [BenefitController::class, 'otherBenefitStore']);
//Attendance bonus
Route::get('hr/setup/attendance_bonus', [AttendanceBonusController::class, 'showForm']);
Route::post('hr/setup/attendance_bonus_store', [AttendanceBonusController::class, 'attBonusStore']);

//Retirement Policy
Route::get('hr/setup/retirement_policy', [RetirementPolicyContorller::class, 'index'])->middleware(['permission:Retirement']);
Route::post('hr/setup/retirement_policy_save', [RetirementPolicyContorller::class, 'saveData'])->middleware(['permission:Retirement']);
Route::get('hr/setup/retirement/get_employee_list', [RetirementPolicyContorller::class, 'getEmployeeList']);
Route::get('hr/setup/retirement/get_employee_details', [RetirementPolicyContorller::class, 'getEmployeeDetails']);

//---------HR / Profile-----------//

//File Tag Print
Route::get('hr/recruitment/file_tag', [FileTagController::class, 'showForm']);
Route::post('hr/reports/filetag/search', [FileTagController::class, 'fileTagSearch']);

// JOB CARD
Route::get('hr/operation/job_card', [ReportsJobCardController::class, 'jobCard'])->middleware(['permission:Job Card']);
Route::get('hr/reports/job-card-report', [ReportsJobCardController::class, 'jobCardByMonth'])->middleware(['permission:Job Card']);
Route::get('hr/reports/job-card-report-data', [ReportsJobCardController::class, 'jobCardData'])->middleware(['permission:Job Card']);
Route::get('hr/operation/job-card-edit', [ReportsJobCardController::class, 'jobCardEdit'])->middleware(['permission:Attendance Operation']);
Route::get('hr/operation/partial_job_card', [ReportsJobCardController::class, 'jobCardPartial']);
// operation
Route::get('hr/operation/job-card-unit-shift', [OperationJobCardController::class, 'unitWiseShift'])->middleware(['permission:Attendance Operation']);
Route::post('hr/operation/job-card-single-update', [OperationJobCardController::class, 'singleUpdate'])->middleware(['permission:Attendance Operation']);
Route::post('hr/operation/individual-salary-process', [OperationJobCardController::class, 'individualSalaryProcess']);

Route::post('hr/operation/special-ot-save', [OperationJobCardController::class, 'otStore']);
Route::post('hr/operation/special-ot-update', [OperationJobCardController::class, 'spOtUpdate']);
Route::post('hr/operation/job-card-shift-change', [OperationJobCardController::class, 'singleShiftChange']);
Route::post('hr/operation/job-card-absent-reason', [OperationJobCardController::class, 'absentReason']);
Route::post('hr/operation/attendance-undo-history', [OperationJobCardController::class, 'attendanceUndo']);
//EMPLOYEE
Route::get('hr/reports/employee_report', [EmployeeReportController::class, 'report']);

Route::get('hr/buyermode/job_card', [BmodeJobCardController::class, 'jobCard']);
Route::get('hr/buyermode/generate_att_salary', [BmodeJobCardController::class, 'generateBuyerModeAttSalary']);

//Salary/Wages Increment Status
Route::get('hr/recruitment/increment_report', [IncrementReportController::class, 'incrementReport']);

Route::get('hr/recruitment/nominee', [NomineeController::class, 'showForm'])->middleware(['permission:Nominee']);
Route::get('hr/reports/leave_log', [LeaveLogController::class, 'showForm'])->middleware(['permission:Leave Log']);
Route::get('hr/reports/leave_check', [LeaveLogController::class, 'checkDueLeave']);

Route::get('hr/reports/salary_sheet', [SalarySheetController::class, 'showForm'])->middleware(['permission:Salary Sheet']);
Route::any('hr/reports/save_salary_sheet', [SalarySheetController::class, 'saveSalarySheet'])->middleware(['permission:Salary Sheet']);
Route::any('hr/reports/print_salary_sheet', [SalarySheetController::class, 'printPage'])->middleware(['permission:Salary Sheet']);

/*Route::get('hr/reports/salary_sheet_unit_wise', 'Hr\Reports\SalarySheetController@salarySheetUnitWise');
Route::post('hr/reports/save_salary_sheet_unit_wise', 'Hr\Reports\SalarySheetController@saveSalarySheetUnit');
Route::get('hr/reports/salary_sheet_unit_wise_day', 'Hr\Reports\SalarySheetController@salarySheetUnitWiseday');

Route::post('hr/reports/save_salary_sheet_unit_wise_data', 'Hr\Reports\SalarySheetController@saveSalarySheetUnitData');*/
// salary
Route::get('hr/reports/salary', [SalaryReportController::class, 'index']);
Route::get('hr/reports/salary-report', [SalaryReportController::class, 'report']);

// salary summery
Route::get('hr/reports/salary-summary', [SalaryReportController::class, 'summeryIndex']);
Route::get('hr/reports/salary-summary-report', [SalaryReportController::class, 'summeryReport']);

// salary data-table
Route::get('hr/reports/monthly-attendance-activity-data', [SalaryReportController::class, 'salaryDataTable']);

// salary disburse
Route::get('hr/operation/unit-wise-salary-sheet', [SalaryReportController::class, 'disburseSheet']);

// salary bank sheet
Route::get('hr/reports/bank-part-salary-report', [SalaryReportController::class, 'bankSheetReport']);


// bill announce
Route::get('hr/reports/bill-announcement', [BillReportController::class, 'index']);
Route::get('hr/reports/bill-announcement-report', [BillReportController::class, 'report']);
Route::get('hr/reports/bill-single-report', [BillReportController::class, 'singleReport']);
// incentive bonus
Route::get('hr/reports/incentive-bonus', [IncentiveReportController::class, 'index']);
Route::get('hr/reports/incentive-bonus-report', [IncentiveReportController::class, 'report']);
// warning notice
Route::get('hr/operation/warning-notice', [WarningNoticeController::class, 'index']);
Route::post('hr/operation/warning-notice-first', [WarningNoticeController::class, 'firstStep']);
Route::post('hr/operation/warning-notice-second', [WarningNoticeController::class, 'secondStep']);
Route::post('hr/operation/warning-notice-third', [WarningNoticeController::class, 'thirdStep']);

Route::get('hr/reports/warning-notices', [WarningNoticeController::class, 'list']);
Route::get('hr/reports/warning-notice-data', [WarningNoticeController::class, 'listData']);

Route::get('hr/operation/payslip', [PayslipController::class, 'showForm'])->middleware(['permission:Payslip']);

Route::get('hr/reports/payslip_buyer', [BmodePaySlipController::class, 'showForm']);

/*Route::get('hr/reports/attendance_report', 'Hr\Reports\AttendanceReportController@showForm')->middleware(['permission:Attendance Report']);*/
Route::get('hr/reports/floor_ass_by_unit', [IncrementReportController::class, 'floorAssByUnit']);

Route::get('hr/reports/attendance_summary_report', [AttendanceReportController::class, 'showForm'])->middleware(['permission:Attendance Summary Report']);

Route::get('hr/reports/get_att_summary_report', [AttendanceReportController::class, 'summaryReport'])->middleware(['permission:Attendance Summary Report']);
Route::get('hr/reports/get-att-emp', [AttendanceReportController::class, 'getAttEmployee'])->middleware(['permission:Attendance Summary Report']);

Route::get('hr/reports/get-daily-att-excel', [AttendanceReportController::class, 'getAttEmployee']);

// reports absent issue
Route::get('hr/reports/before-absent-after-present', [DailyActivityReportController::class, 'beforeAfterStatus']);
Route::get('hr/reports/before-absent-after-present-report', [DailyActivityReportController::class, 'beforeAfterReport']);

// yearly activity
Route::get('hr/reports/employee-yearly-activity', [DailyActivityReportController::class, 'employeeActivity']);
Route::get('hr/reports/employee-yearly-activity-report', [DailyActivityReportController::class, 'employeeActivityReport']);
Route::get('hr/reports/employee-yearly-activity-report-modal', [DailyActivityReportController::class, 'employeeActivityReportModal']);

// Daily Attendance Report
Route::get('hr/reports/daily-attendance-activity', [DailyActivityReportController::class, 'attendance']);

Route::get('hr/reports/daily-attendance-management', [DailyActivityReportController::class, 'management']);


Route::get('hr/reports/daily-attendance-activity-report', [DailyActivityReportController::class, 'attendanceReport']);
Route::get('hr/reports/daily-present-absent-activity-report', [DailyActivityReportController::class, 'presentAbsentReport']);

Route::get('hr/reports/habitual-absent', [DailyActivityReportController::class, 'habitualabsent']);

Route::get('hr/reports/latewarning', [DailyActivityReportController::class, 'latewarning']);
Route::get('hr/reports/viewletter/{id}', [DailyActivityReportController::class, 'viewletter']);

Route::get('hr/reports/hourly_ot', [DailyActivityReportController::class, 'hourly_ot']);

Route::get('hr/reports/hourly_ot_lnf', [DailyActivityReportController::class, 'hourly_ot_lnf']);


Route::get('hr/reports/linechangedaily', [DailyActivityReportController::class, 'linechangedaily']);


Route::get('hr/reports/habitual-absent-excel', [DailyActivityReportController::class, 'habitualabsentexcel']);


Route::get('hr/reports/activity-report-excle', [DailyActivityReportController::class, 'activityExcle']);
// monthly report
Route::get('hr/reports/monthly-attendance-activity', [MonthlyActivityReportController::class, 'attendance']);
// Route::get('hr/reports/monthly-attendance-activity-data', 'Hr\Reports\MonthlyActivityReportController@attendanceData');
Route::get('hr/reports/monthly-reports', [MonthlyReportController::class, 'index']);
Route::get('hr/reports/monthly-maternity-report', [MonthlyReportController::class, 'maternity']);

// daily activity audit
Route::get('hr/daily-activity-audit', [DailyActivityReportController::class, 'attendanceAudit']);

// monthly salary audit
Route::get('hr/reports/monthly-salary-audit-report', [SalaryReportController::class, 'salaryAudit']);
Route::get('hr/monthly-salary-audit', [MonthlyActivityReportController::class, 'salaryAudit']);
Route::post('hr/operation/salary-audit', [SalaryProcessController::class, 'salaryAuditStatus']);
Route::post('hr/operation/salary-individual-audit', [SalaryProcessController::class, 'individualAudit']);

// monthly report
Route::get('hr/reports/monthly-salary', [MonthlyActivityReportController::class, 'salary']);
Route::get('hr/reports/monthly-salary-report', [MonthlyActivityReportController::class, 'salaryReport']);
Route::get('hr/reports/monthly-salary-excel', [MonthlyActivityReportController::class, 'salaryReportExcel']);
Route::get('hr/reports/employee-yearly-salary-modal', [MonthlyActivityReportController::class, 'salaryReportModal']);
Route::get('hr/reports/employee-salary-modal', [MonthlyActivityReportController::class, 'empSalaryModal']);

Route::get('/hr/reports/group-salary-sheet-details', [MonthlyActivityReportController::class, 'groupSalary']);
#------------- Search associate with paramenters(unit, floor, line)---------#
Route::get('hr/reports/search_associate', [IncrementReportController::class, 'searchAssociate']);
Route::get('hr/recruitment/background-verification', [BackgroundController::class, 'backgroundVerification']);
Route::post('hr/recruitment/background-verification', [BackgroundController::class, 'backgroundVerificationStore']);

Route::get('hr/reports/absent_status', [AbsentStatusController::class, 'showForm']);

Route::get('hr/reports/line_wise_att', [LineWiseAttController::class, 'lineWiseAtt']);
Route::get('hr/reports/line_by_unit', [LineWiseAttController::class, 'getLineByUnit']);

// Test
Route::get('hr/reports/line_wise_att2', [LineWiseAttController2::class, 'lineWiseAtt']);
Route::get('hr/reports/line_by_unit2', [LineWiseAttController2::class, 'getLineByUnit']);

//
Route::get('hr/reports/monthy_increment', [MonthlyIncrementController::class, 'increment'])->middleware(['permission:Monthly Increment']);
Route::get('hr/reports/emp_performance/{associate_id}/{date}', [MonthlyIncrementController::class, 'empPerformance']);
Route::post('hr/reports/emp_performance_save', [MonthlyIncrementController::class, 'empPerformanceSave']);
Route::get('hr/reports/emp_performance_increment_list/{associate_id}', [MonthlyIncrementController::class, 'empPerformanceIncrementList']);

Route::get('hr/reports/absent_status', [AbsentStatusController::class, 'showForm']);

// unit wise shift report
Route::get('hr/reports/unit-wise-shift', [UnitReportsController::class, 'shiftIndex']);
Route::get('hr/reports/unit-wise-shift-report', [UnitReportsController::class, 'shiftReport']);
//Buyer Mode
Route::get('hr/setup/buyermode', [BuyerModeSetupController::class, 'buyerMode']);
Route::post('hr/setup/buyermode', [BuyerModeSetupController::class, 'buyerModeStore']);
Route::get('hr/setup/getholidays', [BuyerModeSetupController::class, 'getHolidayList']);
Route::get('hr/setup/buyer_template_update/{id}', [BuyerModeSetupController::class, 'editBuyerModeTemplate']);
Route::post('hr/setup/buyer_template_update', [BuyerModeSetupController::class, 'editActionBuyerModeTemplate']);

Route::get('hr/reports/bonus_slip', [BonusSlipController::class, 'showForm']);
//new bonus slip--------------------------------
Route::get('hr/operation/bonus-sheet', [BonusSlipController::class, 'newShowForm']);
Route::get('hr/reports/bonus-slip-generate', [BonusSlipController::class, 'generate']);
Route::post('hr/reports/employee-bonus-disburse', [BonusSlipController::class, 'disburse']);
//----------------------------------------------
Route::get('hr/reports/floor_by_unit', [BonusSlipController::class, 'floorByUnit']);
Route::get('hr/reports/bonustype_month_year_by_id', [BonusSlipController::class, 'btMonthYear']);
//daily OT Report
Route::get('hr/reports/daily_ot_report', [DailyOTReportController::class, 'dailyOT']);

//worker register
Route::get('hr/reports/worker_register', [workerRegisterController::class, 'workerRegister']);
Route::get('hr/reports/worker_register_table', [workerRegisterController::class, 'workerRegisterList']);

Route::get('hr/reports/worker_register_employee', [workerRegisterController::class, 'associtaeUnitSearch']);

//Unit Attendance report
Route::get('hr/reports/unitattendance', [unitAttendanceController::class, 'unitAttendance']);
Route::get('hr/reports/unitattendance_table', [unitAttendanceController::class, 'unitAttendanceList']);

//Earn Leave Payment Sheet
Route::get('hr/operation/earn-leave-payment', [earnLeaveController::class, 'earnLeavePayment']);
Route::get('hr/reports/earnleavepayment_floor', [earnLeaveController::class, 'floor']);

Route::get('hr/reports/earnleavepayment_table', [earnLeaveController::class, 'earnLeavePaymentList']);

Route::post('hr/reports/earnleavepaymentstore', [earnLeaveController::class, 'earnLeavePaymentStore']);


//Extra OT Sheet

Route::get('hr/reports/extraotsheet', [extraOtSheetController::class, 'extraOtSheet']);
Route::get('hr/reports/extra_ot_list', [extraOtSheetController::class, 'extraOtListGenerate']);
// rubel
Route::get('hr/reports/extra_ot_chank', [extraOtSheetController::class, 'extraOtChank']);
Route::get('hr/reports/extra_ot_chank_list', [extraOtSheetController::class, 'extraOtChankList']);

// Old Fixed Salary Sheet
 Route::get('hr/reports/fixed_salary_list', [FixedSalarySheetController::class, 'fixedSalaryListGenerate']);

// New Fixed salary sheet
Route::get('hr/operation/fixed-salary-sheet', [FixedSalarySheet2Controller::class, 'showForm'])->middleware(['permission:Fixed Salary Sheet']);
//salary sheet generate

Route::get('hr/reports/salary-sheet-generate', [SalarySheetGenerateController::class, 'index']);
Route::post('hr/reports/salary-sheet-generate', [SalarySheetGenerateController::class, 'process']);
Route::post('hr/reports/salary-sheet-generate-process', [SalarySheetGenerateController::class, 'processSalary']);


//Multiple Salary Sheet

Route::get('hr/reports/salary-sheet-custom-multi-search', [SalarySheetCustomController::class, 'multiSearch']);

Route::get('hr/reports/salary-sheet-custom_buyer', [BmodeSalarySheetController::class, 'index']);
Route::get('hr/reports/salary-sheet-custom-multi-search_buyer', [BmodeSalarySheetController::class, 'multiSearch']);
Route::get('hr/reports/ajax_get_employees_buyer', [BmodeSalarySheetController::class, 'ajaxGetEmployee']);

Route::get('hr/operation/salary-sheet', [SalarySheetCustomController::class, 'index'])->middleware(['permission:Salary Sheet']);

//Multiple Salary Sheet ()
Route::prefix('hr/reports')->group(function () {

	Route::get('salary-sheet-custom-extra-ot', [SalarySheetCustomController::class, 'salary_sheet_extra_ot']);
	Route::get('salary-sheet-custom-individual-search', [SalarySheetCustomController::class, 'individualSearch']);
	Route::get('salary-sheet-custom-multi-search', [SalarySheetCustomController::class, 'multiSearch']);
	Route::post('salary-sheet-employee-wise', [SalarySheetCustomController::class, 'employeeWise']);

	Route::get('ajax_get_employees', [SalarySheetCustomController::class, 'ajaxGetEmployee']);
	Route::post('employee-salary-disbursed', [SalarySheetCustomController::class, 'empDisbursed']);

	Route::post('ajax_get_multi_search_result_chunk', [SalarySheetCustomController::class, 'ajaxGetMultiSearchResultChunk']);
	// for extra ot
	Route::post('ajax_get_multi_search_result_extra_ot', [SalarySheetCustomController::class, 'ajaxGetMultiSearchResultExtraOtChunk']);
	Route::post('ajax_get_multi_search_result_list', [SalarySheetCustomController::class, 'ajaxGetMultiSearchResultList']);
});

//Service Book

Route::get('hr/employee/servicebook', [ServiceBookController::class, 'showForm']);
Route::post('hr/operation/servicebookstore', [ServiceBookController::class, 'servicebookStore']);
Route::get('hr/operation/servicebookedit/{sb_id?}', [ServiceBookController::class, 'servicebookEdit']);
Route::post('hr/operation/servicebookupdate', [ServiceBookController::class, 'servicebookUpdate']);
Route::get('hr/operation/servicebookpage', [ServiceBookController::class, 'servicebookPage']);

//Cost Mapping
Route::get('hr/employee/cost-mapping', [CostMappingController::class, 'showForm'])->middleware(['permission:Cost Distribution']);
Route::get('hr/operation/gross_salary', [CostMappingController::class, 'getAssGross'])->middleware(['permission:Cost Distribution']);

Route::post('hr/operation/unit_map', [CostMappingController::class, 'unitMapStore'])->middleware(['permission:Cost Distribution']);
Route::post('hr/operation/area_map', [CostMappingController::class, 'areaMapStore'])->middleware(['permission:Cost Distribution']);
Route::get('hr/operation/cost_mapping/{id}', [CostMappingController::class, 'viewMap'])->middleware(['permission:Cost Distribution']);
Route::get('hr/operation/cost_mapping_edit/{id}', [CostMappingController::class, 'editMap'])->middleware(['permission:Cost Distribution']);

Route::post('hr/operation/unit_map_update', [CostMappingController::class, 'unitMapUpdate'])->middleware(['permission:Cost Distribution']);
Route::post('hr/operation/area_map_update', [CostMappingController::class, 'areaMapUpdate'])->middleware(['permission:Cost Distribution']);

Route::get('hr/employee/cost_mapping_list', [CostMappingController::class, 'mapList'])->middleware(['permission:Cost Distribution List']);
Route::post('hr/operation/cost_mapping_data', [CostMappingController::class, 'mapData'])->middleware(['permission:Cost Distribution List']);

//Frequent Manual Attendance report
Route::get('hr/reports/manual_attendance', [manualAttendanceReportController::class, 'manualAttendanceForm']);
Route::get('hr/reports/manual_attendance_list', [manualAttendanceReportController::class, 'manualAttendanceList']);

// Group Attendance report

Route::get('hr/reports/group_attendance', [GroupAttendanceController::class, 'showForm'])->middleware(['permission:Group Attendance']);
Route::post('hr/reports/group_attendance', [GroupAttendanceController::class, 'showForm'])->middleware(['permission:Group Attendance']);

Route::get('hr/logs/desg_update_log', [LogController::class, 'designationLog']);
Route::post('hr/logs/desg_update_log_data', [LogController::class, 'designationLogData']);


// hr late count default
Route::get('hr/setup/late_count_default', [HrLateCountController::class, 'showForm']);
Route::post('hr/setup/save_late_count_default', [HrLateCountController::class, 'saveLateCountDefault']);
	//----changed on 17-10-2019----
Route::post('hr/setup/ajax_get_shifts', [HrLateCountController::class, 'ajaxGetLateCountUnitValue']);
Route::post('hr/setup/ajax_get_default_value', [HrLateCountController::class, 'ajaxGetLateCountDefaultValue']);
// hr late count customize
Route::get('hr/setup/late_count_customize', [HrLateCountCustomizeController::class, 'showForm']);
Route::get('hr/setup/late_count_customize/get_shifts_by_unit', [HrLateCountCustomizeController::class, 'getShiftsByUnit']);
Route::post('hr/setup/save_late_count_customize', [HrLateCountCustomizeController::class, 'saveLateCountCustomize']);
Route::get('hr/setup/edit_late_count_customize/{id}', [HrLateCountCustomizeController::class, 'editLateCountCustomize']);
Route::post('hr/setup/update_late_count_customize/{id}', [HrLateCountCustomizeController::class, 'updateLateCountCustomize']);
Route::get('hr/setup/delete_late_count_customize/{id}', [HrLateCountCustomizeController::class, 'deleteLateCountCustomize']);

//New Routes----------------------------------------------------------------------------------------------------------
//-----Employee unit change route
Route::get('hr/operation/location_change/list', [LocationChangeController::class, 'showList'])->middleware(['permission:Outside List']);
Route::get('hr/operation/location_change/approve', [LocationChangeController::class, 'approveLocation'])->middleware(['permission:Manage Outside']);
Route::get('hr/operation/location_change/reject/{id}', [LocationChangeController::class, 'rejectLocation'])->middleware(['permission:Manage Outside']);
Route::get('hr/operation/location_change/entry', [LocationChangeController::class, 'showForm'])->middleware(['permission:Manage Outside']);
Route::post('hr/operation/location_change/entry', [LocationChangeController::class, 'storeData'])->middleware(['permission:Manage Outside']);

//------Bonus Type Library
Route::get('hr/setup/bonus_type', [BonusTypeController::class, 'index']);
Route::post('hr/setup/bonus_type_save', [BonusTypeController::class, 'entrySave']);
Route::get('hr/setup/bonus_type_edit', [BonusTypeController::class, 'editDataFetch']);
Route::post('hr/setup/bonus_type_update', [BonusTypeController::class, 'entryUpdate']);
Route::get('hr/setup/bonus_type_delete/{id}', [BonusTypeController::class, 'entryDelete']);

//----Employee Bonus
Route::get('hr/operation/employee_bonus', [EmployeeBonusController::class, 'index']);
Route::post('hr/operation/employee_bonus_save', [EmployeeBonusController::class, 'entrySave']);
Route::get('hr/operation/get_floor', [EmployeeBonusController::class, 'getFloorData']);
Route::get('hr/operation/get_line', [EmployeeBonusController::class, 'getLineData']);
Route::get('hr/operation/get_department', [EmployeeBonusController::class, 'getDepartmentData']);
Route::get('hr/operation/get_section', [EmployeeBonusController::class, 'getSectionData']);
Route::get('hr/operation/get_sub_section', [EmployeeBonusController::class, 'getSubSectionData']);


//-----------Leave Report
Route::get('hr/reports/leave_report', [EmployeeLeaveController::class, 'index']);
Route::get('hr/reports/leave_report_generate', [EmployeeLeaveController::class, 'searchResult']);


//--------Substitude holidays
Route::get('hr/opration/substitute_holiday', [SubstituteHolidayController::class, 'index']);
Route::post('hr/operation/substitute_holiday_save', [SubstituteHolidayController::class, 'saveData']);

//---------HR / ESS-----------//

// Grievance Appeal
Route::get('hr/ess/grievance/appeal_list', [GrievanceAppealController::class, 'showList']);
Route::post('hr/ess/grievance/appeal_data', [GrievanceAppealController::class, 'getData']);
Route::get('hr/ess/grievance/appeal', [GrievanceAppealController::class, 'showForm']);
Route::post('hr/ess/grievance/appeal', [GrievanceAppealController::class, 'saveData']);

// Loan Application
Route::get('hr/payroll/loan_list', [LoanApplicationController::class, 'loanList']);
Route::get('hr/payroll/loan', [LoanApplicationController::class, 'loan']);
Route::post('hr/payroll/loan', [LoanApplicationController::class, 'loanStore']);

Route::post('hr/ess/loan_data', [LoanApplicationController::class, 'getData']);
Route::get('hr/ess/loan_application', [LoanApplicationController::class, 'showForm']);
Route::post('hr/ess/loan_application', [LoanApplicationController::class, 'saveData']);
Route::get('hr/ess/loan_history', [LoanApplicationController::class, 'loanHistory']);
Route::get('hr/ess/loan_status/{id}/{associate_id}', [LoanApplicationController::class, 'showLoanStatus']);
Route::post('hr/ess/loan_status', [LoanApplicationController::class, 'updateLoanStatus']);

// Leave Application
Route::get('hr/ess/leave_application', [LeaveApplicationController::class, 'showForm']);
Route::post('hr/ess/leave_application', [LeaveApplicationController::class, 'saveData']);
Route::get('hr/ess/leave_history', [LeaveApplicationController::class, 'leaveHistory']);
Route::post('hr/ess/leave_check', [LeaveApplicationController::class, 'leaveCheck']);
Route::post('hr/ess/leave_length_check', [LeaveApplicationController::class, 'leaveLeangthCheck']);
Route::post('hr/ess/associates_leave', [LeaveApplicationController::class, 'associatesLeave']);
Route::post('hr/ess/attendance_check', [LeaveApplicationController::class, 'attendanceCheck']);

// Medical Incident
Route::get('hr/employee/medical_incident', [MedicalIncidentController::class, 'medicalIncident']);
Route::post('hr/ess/medical_incident', [MedicalIncidentController::class, 'medicalIncidentStore']);
Route::get('hr/employee/medical_incident_edit/{id}', [MedicalIncidentController::class, 'medicalIncidentEdit']);
Route::post('hr/ess/medical_incident_update', [MedicalIncidentController::class, 'update']);
Route::get('hr/employee/medical_incident_list', [MedicalIncidentController::class, 'medicalIncidentList']);
Route::post('hr/ess/medical_incident_data', [MedicalIncidentController::class, 'medicalIncidentData']);

// aminul route create strat
	Route::get('hr/reports/date-wise-employee', [DateWiseEmployeeController::class, 'index']);
	Route::get('hr/reports/date-wiseloaddata', [DateWiseEmployeeController::class, 'showfilterdata']);
	Route::get('hr/reports/data-annalysis', [DataAnnalysisController::class, 'index']);
	Route::get('hr/reports/data-annalysisloaddata', [DataAnnalysisController::class, 'showfilterdata']);
	Route::get('hr/reports/sub_section_callll', [DataAnnalysisController::class, 'sub_section_call1']);

		Route::get('hr/reports/management-in-out', [DailyActivityReportController::class, 'managementinoutindex']);

		Route::get('hr/reports/management-in-out-getdata', [DailyActivityReportController::class, 'managementinoutgetdata']);

			Route::get('hr/reports/getSectionListByDepartmentID', [DailyActivityReportController::class, 'getSectionListByDepartmentID']);

Route::get('hr/operation/partial-salary-sheet', [PartialSalarySheetController::class, 'index']);
Route::post('hr/operation/partial-salary-create', [PartialSalarySheetController::class, 'create']);

Route::get('hr/operation/partial-salary-getupdatedata/{id}', [PartialSalarySheetController::class, 'getupdatedata']);
Route::post('hr/operation/partial-salary-updatedata', [PartialSalarySheetController::class, 'updatedata']);


Route::get('hr/operation/partial-salary-data-load', [PartialSalarySheetController::class, 'partdataload']);
Route::get('hr/operation/partial-salary-data-delete/{id}', [PartialSalarySheetController::class, 'delete']);

Route::get('hr/operation/partial-salary-find-emp/{id}', [PartialSalarySheetController::class, 'salaryemp']);

Route::get('hr/operation/partial-salary-unitdtl/{id}', [PartialSalarySheetController::class, 'unitdtl']);

Route::get('hr/operation/partial-salary-submitforapprove/{id}', [PartialSalarySheetController::class, 'submitforapprove']);

Route::get('hr/operation/partial-salary-locksalary/{id}', [PartialSalarySheetController::class, 'locksalary']);

Route::post('hr/operation/partial-salary-process', [PartialSalarySheetController::class, 'process']);

Route::get('hr/operation/partial-salary-print', [PartialSalarySheetController::class, 'print']);
Route::get('hr/operation/partial-salary-printload', [PartialSalarySheetController::class, 'printload']);
Route::get('hr/operation/partial-salary-partsalaryexcel', [PartialSalarySheetController::class, 'partsalaryexcel']);

Route::get('hr/operation/partial-salary-approve', [PartialSalarySheetController::class, 'approveview']);

Route::get('hr/operation/partial-salary-approve-flag/{id}', [PartialSalarySheetController::class, 'approveflag']);




Route::get('hr/recruitment/employee/employee_data_Bangla', [EmployeeBanglaController::class, 'index']);

Route::get('hr/recruitment/employee/dropdown_data_Bangla', [EmployeeBanglaController::class, 'getDropdownData']);

Route::get('hr/recruitment/employee/bangla_employee_data', [EmployeeBanglaController::class, 'getData']);





// aminul route create end



//Out Side Rfp

Route::post('hr/ess/out_side_request/entry', [OutsideRequestController::class, 'storeData']);
Route::get('hr/ess/out_side_request/delete/{id}', [OutsideRequestController::class, 'deleteRequest']);

// ess menu
Route::get('ess/out_side_request/entry', [OutsideRequestController::class, 'showForm']);
Route::get('ess/leave_application', [LeaveApplicationController::class, 'showForm']);
Route::get('ess/loan_application', [LoanApplicationController::class, 'showForm']);
Route::get('ess/grievance/appeal', [GrievanceAppealController::class, 'showForm']);

//--------Database Backup---------------//
Route::get('hr/database_backup', [DatabaseBackupController::class, 'index']);
Route::get('hr/db_backup/create', [DatabaseBackupController::class, 'create']);
Route::get('hr/db_file/download/{file_name}', [DatabaseBackupController::class, 'getDownload']);
Route::get('hr/db_file/delete/{file_name}', [DatabaseBackupController::class, 'deleteFile']);
Route::get('hr/db_file/offload/{file_name}', [DatabaseBackupController::class, 'offloadData']);
Route::get('hr/db_file/use_data/{file_name}', [DatabaseBackupController::class, 'loadData']);

///-----Absent or Present List operation..............
Route::get('hr/reports/attendance-consecutive', [AbsentPresentListController::class, 'absentPresentIndex'])->middleware(['permission:Attendance Consecutive Report']);
Route::get('hr/operation/attendance_report_data', [AbsentPresentListController::class, 'attendanceReportData']);
///-----Absent or Present List operation end..............

///---Event-history----///

Route::get("hr/reports/event_history", [EventHistoryController::class, 'showList'])->middleware(['permission:Event History']);
Route::get("hr/reports/event_history_data", [EventHistoryController::class, 'listData'])->middleware(['permission:Event History']);
Route::get("hr/reports/event_history_detail", [EventHistoryController::class, 'getDetail'])->middleware(['permission:Event History']);

// attendance file rollback process
Route::get("hr/operation/attendance-rollback-get-date", [AttendanceRollbackController::class, 'getDate']);
Route::get("hr/operation/attendance-rollback", [AttendanceRollbackController::class, 'index']);
Route::post("hr/operation/attendance-rollback", [AttendanceRollbackController::class, 'process']);

// attendance undo
Route::post('hr/operation/attendance-undo', [AttendanceRollbackController::class, 'attUndo']);
// friday shift ot update
Route::post('hr/timeattendance/friday-ot-update', [FridayShiftController::class, 'otUpdate']);
Route::post('hr/timeattendance/friday-ot-add', [FridayShiftController::class, 'save']);

//system setting routes
Route::get('hr/setup/default_system_setting', [SystemSettingController::class, 'showForm']);
Route::post('hr/setup/default_system_setting_save', [SystemSettingController::class, 'saveForm']);
Route::get('hr/setup/default_system_setting_update/{id}', [SystemSettingController::class, 'updateForm']);
Route::post('hr/setup/default_system_setting_update_data', [SystemSettingController::class, 'updateStore']);
Route::get('hr/setup/default_system_setting_delete/{id}', [SystemSettingController::class, 'deleteData']);

Route::get('hr/att-json', [AttArchiveController::class, 'index']);
Route::get('hr/line-report', [LineReportController::class, 'index']);
// voucher section
Route::get('hr/operation/voucher', [VoucherController::class, 'index']);
Route::post('hr/operation/voucher', [VoucherController::class, 'voucher']);

Route::get('hr/operation/partial-salary', [VoucherController::class, 'partial']);
Route::post('hr/operation/partial-salary', [VoucherController::class, 'partialGenerate']);
Route::post('hr/operation/partial-salary/disburse', [VoucherController::class, 'disburse']);

Route::get('/hr/reports/monthly-ot-report', [ReportController::class, 'monthlyOT']);
Route::get('/hr/reports/monthly-mmr-report', [ReportController::class, 'monthlyMMR']);
Route::get('/hr/reports/unit-employee', [ReportController::class, 'employee']);
Route::get('/hr/reports/unit-designation', [ReportController::class, 'designation']);

// monthly analytics
Route::get('hr/reports/monthly-analytics', [ReportsAnalyticsController::class, 'index']);

Route::get('hr/operation/test', [VoucherController::class, 'test']);
Route::get('hr/test', [TestController::class, 'test']);
Route::get('hr/reports/monthly-salary-sheet', [TestController::class, 'getMonthlySalary']);
Route::get('hr/reports/employee-daily-attendance', [TestController::class, 'exportReport']);

// test route
Route::get('hr/check-report', [TestController::class, 'check']);

Route::prefix('hr/reports/summary')->group(function () {
	Route::get('/', [SummaryReportController::class, 'index']);
	Route::get('/report', [SummaryReportController::class, 'attendanceReport']);
	Route::get('/excel', [SummaryReportController::class, 'excel']);
});

// holiday duty payment
Route::prefix('hr/operation/holiday-duty')->group(function () {

	Route::get('/', [HolidayDutyController::class, 'index']);
	Route::get('/date', [HolidayDutyController::class, 'getData']);

});

Route::get('hr/reports/analytics', [HrAnalyticsController::class, 'index']);
Route::get('hr/recruitment/files', [FileController::class, 'index']);
Route::post('hr/employee/get-file', [FileController::class, 'getFile']);
Route::get('hr/employee/get-history/{id}', [FileController::class, 'gethistory']);




// Buyer Mode
Route::prefix('hr/buyer')->group(function () {
	Route::get('/', [BuyerModeController::class, 'index']);
	Route::post('/generate', [BuyerModeController::class, 'generate']);
	Route::post('/holidays/{id}', [BuyerModeController::class, 'holidays']);
	Route::get('/sync/{id}', [BuyerModeController::class, 'syncIndex']);
	Route::post('/sync/{id}', [BuyerModeController::class, 'sync']);
	Route::post('/salary-process/{id}', [BuyerModeController::class, 'processSalary']);
});

Route::prefix('hrm')->group(function () {
	Route::get('operation/job_card', [BuyerJobCardController::class, 'index']);
	Route::get('timeattendance/attendance_bulk_manual', [BuyerJobCardController::class, 'edit']);
	// salary disburse
	Route::get('operation/salary-sheet', [BuyerSalaryController::class, 'index']);
	Route::get('operation/unit-wise-salary-sheet', [BuyerSalaryController::class, 'unitwise']);
	Route::get('operation/employee-wise-salary-sheet', [BuyerSalaryController::class, 'employeeWise']);

	// payslip
	Route::get('operation/payslip', [BuyerSalaryController::class, 'payslip']);
	Route::get('operation/unit-wise-pay-slip', [BuyerSalaryController::class, 'unitWisePayslip']);

	// reports section
	Route::get('reports/monthly-salary', [BuyerSalaryController::class, 'reports']);
	Route::get('reports/monthly-salary-report', [BuyerSalaryController::class, 'salaryReport']);
	Route::get('reports/monthly-salary-excel', [BuyerSalaryController::class, 'salaryReportExcel']);
	Route::get('/reports/group-salary-sheet-details', [BuyerSalaryController::class, 'groupSalary']);


});

Route::get('hr/setup/earn-leave', [EanrLeaveConfigController::class, 'index']);

// payroll section
Route::prefix('hr/payroll')->group(function () {
	Route::resource('incentive-bonus', IncentiveBonusController::class);
	Route::get('incentive-bonus-employee', [IncentiveBonusController::class, 'employee']);
	Route::post('incentive-bonus-preview', [IncentiveBonusController::class, 'preview']);
});

// mmr setup
Route::get('hr/setup/mmr', [MMRController::class, 'setup']);

Route::get('hr/fetch/shift-list-checkbox', [AttendanceReportController::class, 'fetchShiftListCheckbox']);


// audit routes

Route::get('hr/payroll/maternity-audit', [MaternityAuditController::class, 'index']);

Route::get('hr/audit/fetch/maternity_leave', [MaternityAuditController::class, 'fetch']);
Route::post('hr/audit/action/maternity_leave', [MaternityAuditController::class, 'action']);


Route::get('hr/payroll/end-of-job-audit', [EndOfJobAuditController::class, 'index']);
Route::get('hr/audit/fetch/end-of-job', [EndOfJobAuditController::class, 'fetch']);
Route::post('hr/audit/action/end-of-job', [EndOfJobAuditController::class, 'action']);

Route::get('hr/preview/maternity-benefits/{id}', [MaternityPaymentController::class, 'previewBenefits']);
Route::get('hr/preview/end-of-job-benefits/{id}', [BenefitsCalculationController::class, 'previewBenefits']);
Route::get('hr/preview/partial-salary', [SalaryReportController::class, 'previewSalary']);
