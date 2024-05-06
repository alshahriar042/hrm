<?php

namespace App\Http\Controllers\Backend;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Attendance;
use Carbon\CarbonInterval;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;

class AttendanceController extends Controller
{
    public function index()
    {
        Gate::authorize('attendance.index');

        $employees = User::with('department')->where('role_id', 2)->where('status', 1)->get();
        return view('backend.attendence.index', compact('employees'));
    }


    public function attendence()
    {
        // Gate::authorize('attendance.index');

            $data = DB::table('machine_attendances')->orderBy('created_at','DESC') ->get();

             return view('backend.attendence.machine_atttendence', compact('data'));
    }


    public function attendanceDetails($employeeId)
    {
        Gate::authorize('attendance.details');

        $attendances = Attendance::selectRaw('MONTH(created_at) as month, YEAR(created_at) as year, COUNT(*) as attendance_count')
                        ->where('employee_id', $employeeId)
                        ->groupBy('year', 'month')
                        ->orderBy('year', 'desc')
                        ->orderBy('month', 'desc')
                        ->get();

        return view('backend.attendence.attendence_details', compact('attendances','employeeId'));
    }

    protected function getAlldays($year, $month)
    {
        $daysInMonth = Carbon::createFromDate($year, $month, 1)->daysInMonth;

        $result = [];
        for($i = 1; $i <= $daysInMonth; $i++) {
            $date = Carbon::createFromDate($year, $month, $i)->format("Y-m-d");

            $result[$date] = [
                "date"      => $date,
                "isPresent" => false,
                "isAbsent"  => true,
                "inTime"    => null,
                "outTime"   => null,
                "workingHour" => 0,
                "late"      => 0,
                "overtime"  => 0,
            ];
        }
        return $result;
    }

    public function attendanceReport(Request $request)
    {
        Gate::authorize('attendance.report');

        $year = $request->year;
        $month = $request->month;

        $totalWorkingHours   = 0;
        $totalWorkingMinutes = 0;

        $totalLateHours   = 0;
        $totalLateMinutes = 0;

        $totalOvertimeHours = 0;
        $totalOvertimeMinutes = 0;

        $days = $this->getAlldays($year, $month);

        $attendanceReports = Attendance::with('user')->whereYear('created_at', $year)
                        ->whereMonth('created_at', $month)
                        ->where('employee_id', $request->employee_id)
                        ->get();

        $employee = User::findOrFail($request->employee_id);

        $daysInMonth = Carbon::createFromDate($year, $month, 1)->daysInMonth;

        foreach($attendanceReports as $attendanceReport) {
            $days[$attendanceReport->created_at->format("Y-m-d")]["inTime"] = $attendanceReport->in_time;
            $days[$attendanceReport->created_at->format("Y-m-d")]["outTime"] = $attendanceReport->out_time;

            if(isset($attendanceReport->in_time)) {
                $days[$attendanceReport->created_at->format("Y-m-d")]["isPresent"] = true;
                $days[$attendanceReport->created_at->format("Y-m-d")]["isAbsent"] = false;
            }

            /* working time start here */
            $startTime = new carbon($attendanceReport->in_time);
            $endTime = new Carbon($attendanceReport->out_time);
            $days[$attendanceReport->created_at->format("Y-m-d")]["workingHour"] = $startTime->diff($endTime)->format('%H:%I:%S');
            /* working time end here */

            /* late time start here */
            $graceTime = new Carbon("10:15:00"); // TODO:: Make it dynamic
            $startOfficeTime = new Carbon("10:00:00"); // TODO:: Make it dynamic

            if ($graceTime->format('H:i:s') < $startTime->format('H:i:s')) {
                $days[$attendanceReport->created_at->format("Y-m-d")]["late"] = $startOfficeTime->diff($startTime)->format("%H:%I:%S"); // TODO:: Calculate for only positive times
                $totalLateMinutes += $startOfficeTime->diffInMinutes($startTime);
            }

            $officeWorkingHours = new Carbon("08:00:00"); // TODO:: Make it dynamic
            $totalWorkingHours = Carbon::parse($startTime->diff($endTime)->format('%H:%I:%S'));

            if (strtotime($officeWorkingHours) < strtotime($totalWorkingHours) ) {
                $days[$attendanceReport->created_at->format("Y-m-d")]["overtime"] = $officeWorkingHours->diff($totalWorkingHours)->format("%H:%I:%S"); // TODO:: Calculate for only positive times
                $totalOvertimeMinutes += $officeWorkingHours->diffInMinutes($totalWorkingHours);
            }

            // total working hours
            $totalWorkingMinutes += $endTime->diffInMinutes($startTime);
        }

        $totalWorkingHours = $this->minutesToHour($totalWorkingMinutes);
        $totalLateHours = $this->minutesToHour($totalLateMinutes);
        $totalOvertimeHours = $this->minutesToHour($totalOvertimeMinutes);

        return view('backend.attendence.attendence_report', compact('attendanceReports','employee','daysInMonth','year','month', 'days', 'totalWorkingHours','totalLateHours', 'totalOvertimeHours'));
    }

    /**
     * Converts total minutes to hh:mm format
     */
    protected function minutesToHour($minutes)
    {
        $hours = intval($minutes / 60);
        $minutes = intval($minutes % 60);
        return "{$hours}:{$minutes}";
    }

    public function myAttendance()
    {
        Gate::authorize('my.attendance');

        $employeeId = Auth::user()->id;
        $attendances = Attendance::selectRaw('MONTH(created_at) as month, YEAR(created_at) as year, COUNT(*) as attendance_count')
                        ->where('employee_id', $employeeId)
                        ->groupBy('year', 'month')
                        ->orderBy('year', 'desc')
                        ->orderBy('month', 'desc')
                        ->get();

        return view('backend.attendence.my_attendence_details', compact('attendances','employeeId'));
    }

    public function myAttendanceReport(Request $request)
    {
        Gate::authorize('my.attendance.report');

        $year  = $request->year;
        $month = $request->month;
        $user  = Auth::user();

        $totalWorkingHours   = 0;
        $totalWorkingMinutes = 0;

        $totalLateHours   = 0;
        $totalLateMinutes = 0;

        $totalOvertimeHours = 0;
        $totalOvertimeMinutes = 0;

        $days = $this->getAlldays($year, $month);

        $attendanceReports = Attendance::with('user')->whereYear('created_at', $year)
                        ->whereMonth('created_at', $month)
                        ->where('employee_id', $user->id)
                        ->get();

        $employee = User::findOrFail($user->id);

        $daysInMonth = Carbon::createFromDate($year, $month, 1)->daysInMonth;

        foreach($attendanceReports as $attendanceReport) {
            $days[$attendanceReport->created_at->format("Y-m-d")]["inTime"] = $attendanceReport->in_time;
            $days[$attendanceReport->created_at->format("Y-m-d")]["outTime"] = $attendanceReport->out_time;

            if(isset($attendanceReport->in_time)) {
                $days[$attendanceReport->created_at->format("Y-m-d")]["isPresent"] = true;
                $days[$attendanceReport->created_at->format("Y-m-d")]["isAbsent"] = false;
            }

            /* working time start here */
            $startTime = new carbon($attendanceReport->in_time);
            $endTime = new Carbon($attendanceReport->out_time);
            $days[$attendanceReport->created_at->format("Y-m-d")]["workingHour"] = $startTime->diff($endTime)->format('%H:%I:%S');
            /* working time end here */

            /* late time start here */
            $graceTime = new Carbon("10:15:00"); // TODO:: Make it dynamic
            $startOfficeTime = new Carbon("10:00:00"); // TODO:: Make it dynamic

            if ($graceTime->format('H:i:s') < $startTime->format('H:i:s')) {
                $days[$attendanceReport->created_at->format("Y-m-d")]["late"] = $startOfficeTime->diff($startTime)->format("%H:%I:%S"); // TODO:: Calculate for only positive times
                $totalLateMinutes += $startOfficeTime->diffInMinutes($startTime);
            }

            $officeWorkingHours = new Carbon("08:00:00"); // TODO:: Make it dynamic
            $totalWorkingHours = Carbon::parse($startTime->diff($endTime)->format('%H:%I:%S'));

            if (strtotime($officeWorkingHours) < strtotime($totalWorkingHours) ) {
                $days[$attendanceReport->created_at->format("Y-m-d")]["overtime"] = $officeWorkingHours->diff($totalWorkingHours)->format("%H:%I:%S"); // TODO:: Calculate for only positive times
                $totalOvertimeMinutes += $officeWorkingHours->diffInMinutes($totalWorkingHours);
            }

            // total working hours
            $totalWorkingMinutes += $endTime->diffInMinutes($startTime);
        }

        $totalWorkingHours = $this->minutesToHour($totalWorkingMinutes);
        $totalLateHours = $this->minutesToHour($totalLateMinutes);
        $totalOvertimeHours = $this->minutesToHour($totalOvertimeMinutes);

        return view('backend.attendence.my_attendence_report', compact('attendanceReports','employee','daysInMonth','year','month', 'days', 'totalWorkingHours','totalLateHours', 'totalOvertimeHours'));
    }
}
