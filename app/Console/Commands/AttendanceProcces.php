<?php

namespace App\Console\Commands;

use Carbon\Carbon;
use Rats\Zkteco\Lib\ZKTeco;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class AttendanceProcces extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'attendence:process';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Attendance process';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $zk = new ZKTeco('10.10.10.37', 8000);

        if ($zk->connect()) {

            $attendanceArray = $zk->getAttendance();
            $attendanceJson = json_encode($attendanceArray);
            $attendanceData = json_decode($attendanceJson, true);

            foreach ($attendanceData as $data) {
                // Retrieve the attendance record for the user on the specified date
                $attendance = DB::table('machine_attendances')
                    ->where('user_id', $data['id'])
                    ->where('date', Carbon::parse($data['timestamp'])->toDateString())
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

            $currentDate = Carbon::now()->toDateString();
            Log::info("Attendance records updated successfully for date: $currentDate.");
            $this->info('Attendance records updated successfully.');
        }

    }
}
