<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Backend\LabController;
use App\Http\Controllers\Backend\BlogController;
use App\Http\Controllers\Backend\RoleController;
use App\Http\Controllers\Backend\TestController;
use App\Http\Controllers\Backend\UserController;
use App\Http\Controllers\Backend\AboutController;
use App\Http\Controllers\Backend\EventController;
use App\Http\Controllers\Backend\SliderController;
use App\Http\Controllers\Backend\ContactController;
use App\Http\Controllers\Backend\LabTypeController;
use App\Http\Controllers\Backend\ProfileController;
use App\Http\Controllers\Backend\DistrictController;
use App\Http\Controllers\Backend\DivisionController;
use App\Http\Controllers\Backend\TutorialController;
use App\Http\Controllers\Backend\DashboardController;
use App\Http\Controllers\Backend\ParameterController;
use App\Http\Controllers\Backend\AttendanceController;
use App\Http\Controllers\Backend\DepartmentController;
use App\Http\Controllers\Backend\InstrumentController;
use App\Http\Controllers\Backend\UserManualController;
use App\Http\Controllers\Backend\InTimeOutTimeController;
use App\Http\Controllers\Backend\ReconciliationController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Auth::routes(['register' => false]);

Route::group(['middleware' => 'auth'], function () {
    Route::get('home', [DashboardController::class, 'index'])->name('dashboard');

    Route::resource('roles', RoleController::class);
    Route::resource('users', UserController::class);

    Route::controller(ProfileController::class)->group(function () {
        Route::get('profile','index')->name('profile');
        Route::get('profile/edit','edit')->name('profile.edit');
        Route::post('profile/update','update')->name('profile.update');
        Route::get('/change-password', 'changePassword')->name('change.password');
        Route::post('/password/update', 'passwordUpdate')->name('password.change.update');
    });

    Route::resource('departments', DepartmentController::class);
    Route::post('set-intime', [InTimeOutTimeController::class, "setInTime"])->name('set.intime');
    Route::post('set-outtime', [InTimeOutTimeController::class, "setOutTime"])->name('set.outtime');

    Route::get('attendance', [AttendanceController::class, "index"])->name('attendance.index');
    Route::get('attendance/{employeeId}/details', [AttendanceController::class, "attendanceDetails"])->name('attendance.details');
    Route::get('attendance/report', [AttendanceController::class, "attendanceReport"])->name('attendance.report');
    Route::get('my-attendance', [AttendanceController::class, "myAttendance"])->name('my.attendance');
    Route::get('my-attendance/report', [AttendanceController::class, "myAttendanceReport"])->name('my.attendance.report');
    Route::get('machine-attendance', [AttendanceController::class, "attendence"])->name('machine.attendance.report');

    Route::resource('reconciliations', ReconciliationController::class);
    Route::get('pending-reconciliation', [ReconciliationController::class, "pendingReconciliation"])->name('pending.reconciliation');
    Route::get('approve-reconciliation/{id}', [ReconciliationController::class, "approveReconciliation"])->name('approve.reconciliation');
    Route::post('reject-reconciliation', [ReconciliationController::class, "rejectReconciliation"])->name('reject.reconciliation');
    Route::get('reconciliations/remark/{id}', [ReconciliationController::class, "reconciliationsRemark"]);
});
