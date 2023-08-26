<?php

use App\Http\Controllers\Admin\DesignationController;
use App\Http\Controllers\Admin\EmployeeTypeController;
use App\Http\Controllers\Admin\GradeController;
use App\Http\Controllers\Admin\HolidayController;
use App\Http\Controllers\Admin\LeaveTypeController;
use App\Http\Controllers\Admin\NationalityController;
use App\Http\Controllers\Admin\OrganizationController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Admin\OrganizationTypeController;
use App\Http\Controllers\Admin\PermissionTypeController;
use App\Http\Controllers\Admin\RamdanScheduleController;
use App\Http\Controllers\Admin\ReasonController;
use App\Http\Controllers\Admin\RegionController;
use App\Http\Controllers\Admin\ScheduleController;
use App\Http\Controllers\Admin\ScheduleLocationController;
use App\Http\Controllers\Admin\ScheduleTimeController;
use App\Http\Controllers\Admin\ScheduleTypeController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });
Route::group(['middleware' => 'api'], static function () {
    Route::post('/admin/login', [AuthController::class, 'loginAsAdmin']);
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::post('/refresh', [AuthController::class, 'refresh']);

    Route::namespace('Admin')->middleware('admin')->group(function () {
        //  organization-types
        Route::prefix('organization-types')->group(function () {
            Route::get('/', [OrganizationTypeController::class, 'index']);
            Route::post('/', [OrganizationTypeController::class, 'store']);
            Route::post('/{id}', [OrganizationTypeController::class, 'update']);
            Route::delete('/{id}', [OrganizationTypeController::class, 'destroy']);
        });
        //  organization
        Route::prefix('organizations')->group(function () {
            Route::get('/', [OrganizationController::class, 'index']);
            Route::post('/', [OrganizationController::class, 'store']);
            Route::post('/{id}', [OrganizationController::class, 'update']);
            Route::delete('/{id}', [OrganizationController::class, 'destroy']);
        });
        //  regions
        Route::prefix('regions')->group(function () {
            Route::get('/', [RegionController::class, 'index']);
            Route::post('/', [RegionController::class, 'store']);
            Route::post('/{id}', [RegionController::class, 'update']);
            Route::delete('/{id}', [RegionController::class, 'destroy']);
        });
        //  nationalities
        Route::prefix('nationalities')->group(function () {
            Route::get('/', [NationalityController::class, 'index']);
            Route::post('/', [NationalityController::class, 'store']);
            Route::post('/{id}', [NationalityController::class, 'update']);
            Route::delete('/{id}', [NationalityController::class, 'destroy']);
        });
        //  reasons
        Route::prefix('reasons')->group(function () {
            Route::get('/', [ReasonController::class, 'index']);
            Route::post('/', [ReasonController::class, 'store']);
            Route::post('/{id}', [ReasonController::class, 'update']);
            Route::delete('/{id}', [ReasonController::class, 'destroy']);
        });
        //  grades
        Route::prefix('grades')->group(function () {
            Route::get('/', [GradeController::class, 'index']);
            Route::post('/', [GradeController::class, 'store']);
            Route::post('/{id}', [GradeController::class, 'update']);
            Route::delete('/{id}', [GradeController::class, 'destroy']);
        });
        //  designations
        Route::prefix('designations')->group(function () {
            Route::get('/', [DesignationController::class, 'index']);
            Route::post('/', [DesignationController::class, 'store']);
            Route::post('/{id}', [DesignationController::class, 'update']);
            Route::delete('/{id}', [DesignationController::class, 'destroy']);
        });
        //  employee-types
        Route::prefix('employee-types')->group(function () {
            Route::get('/', [EmployeeTypeController::class, 'index']);
            Route::post('/', [EmployeeTypeController::class, 'store']);
            Route::post('/{id}', [EmployeeTypeController::class, 'update']);
            Route::delete('/{id}', [EmployeeTypeController::class, 'destroy']);
        });
        //  permission-types
        Route::prefix('permission-types')->group(function () {
            Route::get('/', [PermissionTypeController::class, 'index']);
            Route::post('/', [PermissionTypeController::class, 'store']);
            Route::post('/{id}', [PermissionTypeController::class, 'update']);
            Route::delete('/{id}', [PermissionTypeController::class, 'destroy']);
        });
        //  leave-types
        Route::prefix('leave-types')->group(function () {
            Route::get('/', [LeaveTypeController::class, 'index']);
            Route::post('/', [LeaveTypeController::class, 'store']);
            Route::post('/{id}', [LeaveTypeController::class, 'update']);
            Route::delete('/{id}', [LeaveTypeController::class, 'destroy']);
        });
        //  holidays
        Route::prefix('holidays')->group(function () {
            Route::get('/', [HolidayController::class, 'index']);
            Route::post('/', [HolidayController::class, 'store']);
            Route::post('/{id}', [HolidayController::class, 'update']);
            Route::delete('/{id}', [HolidayController::class, 'destroy']);
        });

        //Schedule
        Route::prefix('schedule')->group(function () {
            Route::get('/', [ScheduleController::class, 'index']);
            Route::post('/', [ScheduleController::class, 'store']);
            Route::post('/{id}', [ScheduleController::class, 'update']);
            Route::delete('/{id}', [ScheduleController::class, 'destroy']);
        });
        //schedule-location
        Route::prefix('schedule-locations')->group(function () {
            Route::get('/', [ScheduleLocationController::class, 'index']);
            Route::post('/', [ScheduleLocationController::class, 'store']);
            Route::post('/{id}', [ScheduleLocationController::class, 'update']);
            Route::delete('/{id}', [ScheduleLocationController::class, 'destroy']);
        });
        //schedule-types
        Route::prefix('schedule-types')->group(function () {
            Route::get('/', [ScheduleTypeController::class, 'index']);
            Route::post('/', [ScheduleTypeController::class, 'store']);
            Route::post('/{id}', [ScheduleTypeController::class, 'update']);
            Route::delete('/{id}', [ScheduleTypeController::class, 'destroy']);
        });
        //schedule-times
        Route::prefix('schedule-times')->group(function () {
            Route::get('/', [ScheduleTimeController::class, 'index']);
            Route::post('/', [ScheduleTimeController::class, 'store']);
            Route::post('/{id}', [ScheduleTimeController::class, 'update']);
            Route::delete('/{id}', [ScheduleTimeController::class, 'destroy']);
        });
        //ramadan-schedule
        Route::prefix('ramdan-schedules')->group(function(){
            Route::get('/',[RamdanScheduleController::class,'index']);
            Route::post('/',[RamdanScheduleController::class,'store']);
            Route::post('/{id}',[RamdanScheduleController::class,'update']);
            Route::delete('/{id}',[RamdanScheduleController::class,'destroy']);
        });
    });
});


// <?php

// use App\Http\Controllers\Admin\DesignationController;
// use App\Http\Controllers\Admin\EmployeeTypeController;
// use App\Http\Controllers\Admin\GradeController;
// use App\Http\Controllers\Admin\HolidayController;
// use App\Http\Controllers\Admin\LeaveTypeController;
// use App\Http\Controllers\Admin\NationalityController;
// use App\Http\Controllers\Admin\OrganizationController;
// use App\Http\Controllers\AuthController;
// use App\Http\Controllers\Admin\OrganizationTypeController;
// use App\Http\Controllers\Admin\PermissionTypeController;
// use App\Http\Controllers\Admin\ReasonController;
// use App\Http\Controllers\Admin\RegionController;
// use App\Http\Controllers\Admin\ScheduleLocationController;
// use App\Http\Controllers\Admin\ScheduleTimeController;
// use App\Http\Controllers\Admin\ScheduleTypeController;
// use Illuminate\Support\Facades\Route;

// /*
// |--------------------------------------------------------------------------
// | API Routes
// |--------------------------------------------------------------------------
// |
// | Here is where you can register API routes for your application. These
// | routes are loaded by the RouteServiceProvider and all of them will
// | be assigned to the "api" middleware group. Make something great!
// |
// */

// // Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
// //     return $request->user();
// // });
// Route::group(['middleware' => 'api'], static function () {
//     Route::post('/admin/login', [AuthController::class, 'loginAsAdmin']);
//     Route::post('/logout', [AuthController::class, 'logout']);
//     Route::post('/refresh', [AuthController::class, 'refresh']);

//     Route::namespace('Admin')->middleware('admin')->group(function () {
//         //  organization-types
//         Route::prefix('organization-types')->group(function () {
//             Route::get('/', [OrganizationTypeController::class, 'index']);
//             Route::post('/', [OrganizationTypeController::class, 'store']);
//             Route::post('/{id}', [OrganizationTypeController::class, 'update']);
//             Route::delete('/{id}', [OrganizationTypeController::class, 'destroy']);
//         });
//         //  organization
//         Route::prefix('organizations')->group(function () {
//             Route::get('/', [OrganizationController::class, 'index']);
//             Route::post('/', [OrganizationController::class, 'store']);
//             Route::post('/{id}', [OrganizationController::class, 'update']);
//             Route::delete('/{id}', [OrganizationController::class, 'destroy']);
//         });
//         //  regions
//         Route::prefix('regions')->group(function () {
//             Route::get('/', [RegionController::class, 'index']);
//             Route::post('/', [RegionController::class, 'store']);
//             Route::post('/{id}', [RegionController::class, 'update']);
//             Route::delete('/{id}', [RegionController::class, 'destroy']);
//         });
//         //  nationalities
//         Route::prefix('nationalities')->group(function () {
//             Route::get('/', [NationalityController::class, 'index']);
//             Route::post('/', [NationalityController::class, 'store']);
//             Route::post('/{id}', [NationalityController::class, 'update']);
//             Route::delete('/{id}', [NationalityController::class, 'destroy']);
//         });
//         //  reasons
//         Route::prefix('reasons')->group(function () {
//             Route::get('/', [ReasonController::class, 'index']);
//             Route::post('/', [ReasonController::class, 'store']);
//             Route::post('/{id}', [ReasonController::class, 'update']);
//             Route::delete('/{id}', [ReasonController::class, 'destroy']);
//         });
//         //  grades
//         Route::prefix('grades')->group(function () {
//             Route::get('/', [GradeController::class, 'index']);
//             Route::post('/', [GradeController::class, 'store']);
//             Route::post('/{id}', [GradeController::class, 'update']);
//             Route::delete('/{id}', [GradeController::class, 'destroy']);
//         });
//         //  designations
//         Route::prefix('designations')->group(function () {
//             Route::get('/', [DesignationController::class, 'index']);
//             Route::post('/', [DesignationController::class, 'store']);
//             Route::post('/{id}', [DesignationController::class, 'update']);
//             Route::delete('/{id}', [DesignationController::class, 'destroy']);
//         });
//         //  employee-types
//         Route::prefix('employee-types')->group(function () {
//             Route::get('/', [EmployeeTypeController::class, 'index']);
//             Route::post('/', [EmployeeTypeController::class, 'store']);
//             Route::post('/{id}', [EmployeeTypeController::class, 'update']);
//             Route::delete('/{id}', [EmployeeTypeController::class, 'destroy']);
//         });
//         //  permission-types
//         Route::prefix('permission-types')->group(function () {
//             Route::get('/', [PermissionTypeController::class, 'index']);
//             Route::post('/', [PermissionTypeController::class, 'store']);
//             Route::post('/{id}', [PermissionTypeController::class, 'update']);
//             Route::delete('/{id}', [PermissionTypeController::class, 'destroy']);
//         });
//         //  leave-types
//         Route::prefix('leave-types')->group(function () {
//             Route::get('/', [LeaveTypeController::class, 'index']);
//             Route::post('/', [LeaveTypeController::class, 'store']);
//             Route::post('/{id}', [LeaveTypeController::class, 'update']);
//             Route::delete('/{id}', [LeaveTypeController::class, 'destroy']);
//         });
//         //  holidays
//         Route::prefix('holidays')->group(function () {
//             Route::get('/', [HolidayController::class, 'index']);
//             Route::post('/', [HolidayController::class, 'store']);
//             Route::post('/{id}', [HolidayController::class, 'update']);
//             Route::delete('/{id}', [HolidayController::class, 'destroy']);
//         });
//         //schedule-location
//         Route::prefix('schedule-locations')->group(function () {
//             Route::get('/', [ScheduleLocationController::class, 'index']);
//             Route::post('/', [ScheduleLocationController::class, 'store']);
//             Route::post('/{id}', [ScheduleLocationController::class, 'update']);
//             Route::delete('/{id}', [ScheduleLocationController::class, 'destroy']);
//         });
//         //schedule-types
//         Route::prefix('schedule-types')->group(function () {
//             Route::get('/', [ScheduleTypeController::class, 'index']);
//             Route::post('/', [ScheduleTypeController::class, 'store']);
//             Route::post('/{id}', [ScheduleTypeController::class, 'update']);
//             Route::delete('/{id}', [ScheduleTypeController::class, 'destroy']);
//         });
//         //schedule-times
//         Route::prefix('schedule-times')->group(function () {
//             Route::get('/', [ScheduleTimeController::class, 'index']);
//             Route::post('/', [ScheduleTimeController::class, 'store']);
//             Route::post('/{id}', [ScheduleTimeController::class, 'update']);
//             Route::delete('/{id}', [ScheduleTimeController::class, 'destroy']);
//         });
//     });
// });
