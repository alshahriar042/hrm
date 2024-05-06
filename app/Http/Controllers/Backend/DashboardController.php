<?php

namespace App\Http\Controllers\Backend;

use App\Models\Attendance;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Department;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $departments      = Department::where('status', 1)->get();
        $todayAttendence  = Attendance::whereDate("created_at", date("Y-m-d"))->get();
        $employees        = User::with('department','todayAttendance')->where('role_id', 2)->where('status', 1)->get();
        $attendence       = Attendance::where('employee_id', Auth::id())->whereDate('created_at', date('Y-m-d'))->orderBy('id','DESC')->first();

        return view('backend.dashboard.index', compact('attendence','employees','departments','todayAttendence'));
    }
}
