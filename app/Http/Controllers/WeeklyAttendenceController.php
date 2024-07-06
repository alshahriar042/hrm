<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class WeeklyAttendenceController extends Controller
{
    public function calculateAttendance(Request $request)
    {
        // $startDate = Carbon::parse($request->input('start_date'));
        // $endDate = Carbon::parse($request->input('end_date'));

        $startDate = Carbon::parse('2024-05-01');
        $endDate = Carbon::parse('2024-06-09');

        // Define office hours

        $standardHours = 9;

        // Fetch users and create a lookup array
        $users = DB::table('users')->get();

        // Initialize the userAttendances array
        $userAttendances = [];
        foreach ($users as $user) {
            $userAttendances[$user->id] = [
                'user_name' => $user->name,
                'user_id' => $user->emp_id,
                'total_working_hours' => 0,
                'overtime' => 0,
                'less_time' => 0
            ];
        }

        // Fetch attendance data within the date range
        $attendances = DB::table('machine_attendances')
            //    ->whereBetween('date', [$startDate, $endDate])
            ->get();

        $dateCounts = DB::table('machine_attendances')
            ->distinct()
            ->count('date');

        $totalHours = [];

        foreach ($attendances as $record) {
            if ($record->check_in && $record->check_out) {
                $checkIn = strtotime($record->check_in);
                $checkOut = strtotime($record->check_out);
                $diff = $checkOut - $checkIn;
                $hours = round($diff / 3600, 2);

                if (isset($totalHours[$record->user_id])) {
                    $totalHours[$record->user_id]['total_hours'] += round($hours);
                } else {
                    $totalHours[$record->user_id] = [
                        'id' => $record->user_id,
                        'user_name' => $record->user_name,
                        'accual' =>  ($dateCounts-5)* 9,
                        'total_hours' => round($hours),
                    ];
                }
            }
        }

        // Re-index the array starting from 1
        $totalHours = array_values($totalHours);

        return $totalHours;
    }
}
