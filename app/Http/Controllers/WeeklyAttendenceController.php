<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class WeeklyAttendenceController extends Controller
{

    public function index()
    {

        return view('backend.weeklyRecord.create');
    }
    public function calculateAttendance(Request $request)
    {

        $startOfWeek = $request->startOfWeek;
        $endOfWeek = $request->endOfWeek;

        //  $weeklyData = DB::table('machine_attendances as m')
        //     ->join('users as u', 'm.user_id', '=', 'u.emp_id')
        //     ->select(
        //         'u.name',
        //         'u.emp_id',
        //         DB::raw("CONCAT(
        //     FLOOR(SUM(LEAST(9 * 60, TIMESTAMPDIFF(MINUTE, m.check_in, m.check_out))) / 60),
        //     ' hours ',
        //     MOD(SUM(LEAST(9 * 60, TIMESTAMPDIFF(MINUTE, m.check_in, m.check_out))), 60),
        //     ' minutes'
        // ) AS total_weekly_hours")
        //     )
        //     ->whereBetween('m.date', [$startOfWeek, $endOfWeek])
        //     // ->whereNotNull('m.check_in')
        //     // ->whereNotNull('m.check_out')
        //     ->groupBy('u.name', 'u.emp_id')
        //     ->orderBy('u.emp_id')
        //     ->get();

        $weeklyData = DB::table('machine_attendances as m')
            ->join('users as u', 'm.user_id', '=', 'u.emp_id')
            ->select(
                'u.name',
                'u.emp_id',
                DB::raw("CONCAT(
            FLOOR(SUM(TIMESTAMPDIFF(MINUTE, m.check_in, m.check_out)) / 60),
            ' hours ',
            MOD(SUM(TIMESTAMPDIFF(MINUTE, m.check_in, m.check_out)), 60),
            ' minutes'
        ) AS total_weekly_hours")
            )
            ->whereBetween('m.date', [$startOfWeek, $endOfWeek])
            // ->whereNotNull('m.check_in')
            // ->whereNotNull('m.check_out')
            ->groupBy('u.name', 'u.emp_id')
            ->orderBy('u.emp_id')
            ->get();


        return  view('backend.weeklyRecord.index', compact('weeklyData', 'startOfWeek', 'endOfWeek'));
    }
}
