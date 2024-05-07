<?php

namespace App\Http\Controllers;

use Rats\Zkteco\Lib\ZKTeco;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MachineAttendenceController extends Controller
{
    // public function index()
    // {
    //     $zk = new ZKTeco('10.10.10.32');

    //     if ($zk->connect()) {

    //         $attendenceArray = $zk->getAttendance();
    //         $attendenceJson = json_encode($attendenceArray);
    //         $data = json_decode($attendenceJson, true);

    //         foreach ($data as $record) {
    //             $userId = $record['id'];
    //             $timestamp = $record['timestamp'];
    //             $type = $record['type'];

    //             $name = DB::table('users')->where('emp_id', $userId)->first();

    //             if ($type == 0) {
    //                 DB::table('machine_attendances')->updateOrInsert(
    //                     ['user_id' => $userId],
    //                     ['user_name' => @$name->name],
    //                     ['check_in' => $timestamp]
    //                 );
    //             } elseif ($type == 1) {
    //                 DB::table('machine_attendances')->where('user_id', $userId)->update(['check_out' => $timestamp]);
    //             }
    //         }

    //         return response()->json(['message' => 'Attendance data inserted successfully'], 200);
    //     }
    // }

    public function index()
    {
        $zk = new ZKTeco('203.96.226.122',8000);

        if ($zk->connect()) {

             $attendanceArray = $zk->getAttendance();
            $attendanceJson = json_encode($attendanceArray);
            $data = json_decode($attendanceJson, true);

            // Initialize arrays to store check-in and check-out timestamps for each user on each day
            $checkIns = [];
            $checkOuts = [];

            foreach ($data as $record) {
                $userId = $record['id'];
                $timestamp = $record['timestamp'];
                $type = $record['type'];

                // Convert timestamp to a date to identify the day
                $date = date('Y-m-d', strtotime($timestamp));

                // Store check-in and check-out timestamps in separate arrays
                if ($type == 0) {
                    if (!isset($checkIns[$userId][$date])) {
                        $checkIns[$userId][$date] = $timestamp;
                    }
                } elseif ($type == 1) {
                    $checkOuts[$userId][$date] = $timestamp;
                }
            }

            // Process check-ins and check-outs for each user and date
            foreach ($checkIns as $userId => $userCheckIns) {
                foreach ($userCheckIns as $date => $checkIn) {
                    $checkOut = isset($checkOuts[$userId][$date]) ? $checkOuts[$userId][$date] : null;

                    // Check if an attendance record exists for this user and date
                    $existingAttendance = DB::table('machine_attendances')
                                            ->where('user_id', $userId)
                                            ->whereDate('check_in', $date)
                                            ->first();
                    $name =DB::table('users')->where('emp_id', $userId)->first();

                    if (!$existingAttendance) {
                        // If no record exists for this user and date, insert a new record
                        DB::table('machine_attendances')->insert([
                            'user_id' => $userId,
                            'user_name' => $name->name,
                            'check_in' => $checkIn,
                            'check_out' => $checkOut,
                            'created_at' =>$checkIn

                            // 'date' => $date // Store the date
                        ]);
                    } else {
                        // Update the existing record with the latest check-out time
                        DB::table('machine_attendances')
                            ->where('user_id', $userId)
                            ->whereDate('check_in', $date)
                            ->update(['check_out' => $checkOut,
                        'updated_at' =>$checkOut]);
                    }
                }
            }

            return response()->json(['message' => 'Attendance data inserted successfully'], 200);
        }else{
            return response()->json(['message' => 'Not Connect'], 422);

        }

    }


}
