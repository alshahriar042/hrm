<?php

use App\Http\Controllers\FirebaseController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;
use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\MachineAttendenceController;
use App\Http\Controllers\WeeklyAttendenceController;

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

Route::get('/', function () {
    return redirect()->route('login');
});



Route::get('/record', [MachineAttendenceController::class, 'userRecord'])->name('userRecord.attendence');
Route::get('/attendence', [MachineAttendenceController::class, 'index'])->name('attendence');
Route::get('/clear', [MachineAttendenceController::class, 'crearMachineData'])->name('clear.attendence');
Route::get('/week', [WeeklyAttendenceController::class, 'calculateAttendance'])->name('calculateAttendance');
Route::get('/attendance-form', [WeeklyAttendenceController::class, 'index'])->name('attendance.form');
Route::get('/attendance-form', [WeeklyAttendenceController::class, 'index'])->name('attendance.form');




// Route::get('/attendance-form', function () {
//     return view('backend.weeklyRecord.create');
// });



