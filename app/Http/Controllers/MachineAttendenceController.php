<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;


use Rats\Zkteco\Lib\ZKTeco;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class MachineAttendenceController extends Controller
{


    public function index()
    {
        //  $zk = new ZKTeco('203.96.226.122', 8000);
         $zk = new ZKTeco('10.10.10.10', 8000);


        if ($zk->connect()) {

            $attendanceArray = $zk->getAttendance();
            $attendanceJson = json_encode($attendanceArray);
            $attendanceData = json_decode($attendanceJson, true);

            foreach ($attendanceData as $data) {
                // Retrieve the attendance record for the user on the specified date
                     $attendance = DB::table('machine_attendances')
                    ->where('user_id', $data['id'])
                    ->where('date', Carbon::parse($data['timestamp'])->toDateString())
                    // ->where('date', "2024-05-27")
                    ->first();

                if ($attendance) {
                    // Update check-in time if not already set and type is 0 (for check-in)
                    if (($data['type'] == 0) && ($attendance->check_in ==null)) {
                        DB::table('machine_attendances')
                            ->where('id', $attendance->id)
                            ->update(['check_in' => $data['timestamp'],
                            'created_at' => $data['timestamp']]);
                    }

                    // Update check-out time always
                    if ($data['type'] == 1) {
                        DB::table('machine_attendances')
                            ->where('id', $attendance->id)
                            ->update(['check_out' => $data['timestamp'],
                                  'updated_at' => $data['timestamp']]);

                    }
                }
            }
            $zk->clearAttendance();
           return  response()->json(['message' => 'Attendance data inserted successfully'], 200);

        }else{
            return response()->json(['message' => 'Machine Not Connected'], 422);

        }


    }


    public function userRecord(){
        $date = Carbon::now()->toDateString();
        $users = User::where('id', '!=', 24)->get();

        foreach ($users as $user) {

            $existingAttendance = DB::table('machine_attendances')
            ->where('user_id', $user->emp_id)
            ->where('date', $date)
            ->exists();

            if ($existingAttendance) {
                continue;
            }

            DB::table('machine_attendances')->insert([
                'user_id' => $user->emp_id,
                'user_name' => $user->name,
                'check_in' => null,
                'check_out' => null,
                'date' => $date,
            ]);
        }

        return response()->json(['message' => 'Attendance table populated with user data'], 200);

    }


}
