<?php

namespace App\Console\Commands;

use Carbon\Carbon;
use App\Services\SMSService;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Mail;

class CheckAttendance extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'attendance:check';


    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Check for missing check-ins and send notifications';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $today = Carbon::now();
        $dayOfWeek = $today->dayOfWeek;

        // Skip Friday (5) and Saturday (6)
        if (in_array($dayOfWeek, [5, 6])) {
            return;
        }

        // 9:30 AM logic
        if ($today->format('H:i') === '10:30') {
            $this->checkMissingCheckIns();
        }

        // 8:00 PM logic
        if ($today->format('H:i') === '21:00') {
            $this->sendCheckInAndOutTimes();
        }
    }

    protected function checkMissingCheckIns()
    {
        $today = Carbon::today()->format('Y-m-d'); // Format the date as YYYY-MM-DD
        $missingCheckIns = DB::table('machine_attendances')->whereDate('date', Carbon::today())
            ->whereNull('check_in')
            ->get();

            Log::info($missingCheckIns);

        foreach ($missingCheckIns as $attendance) {
            $user = $attendance->user_id;
            $data = DB::table('users')->where('emp_id', $user)->first();
            $message = "You have not checked in today- ($today) - Nextgen Innovation Ltd.";
            // SMSService::sendSms($data->phone, $message);
            $this->sendEmail($data->email, 'Missing Check-In', $message);
        }
    }

    protected function sendCheckInAndOutTimes()
{
    $today = Carbon::today()->format('Y-m-d'); // Format the date as YYYY-MM-DD

    $attendances = DB::table('machine_attendances')->whereDate('date', Carbon::today())
        ->whereNotNull('check_in')
        ->get();

    foreach ($attendances as $attendance) {
        $user = $attendance->user_id;
        $data = DB::table('users')->where('emp_id', $user)->first();

        if ($data) {  // Ensure user data is found
            $checkOutTime = $attendance->check_out ? $attendance->check_out : 'Not Checked Out';
            $message = "Check-In: {$attendance->check_in}, Check-Out: {$checkOutTime}, Date: {$today} - Nextgen Innovation Ltd.";
            // $this->sendSms($data->phone, $message);
            $this->sendEmail($data->email, 'Check-In and Check-Out Times', $message);
        }
    }
}




    protected function sendEmail($email, $subject, $message)
    {
        Mail::raw($message, function ($msg) use ($email, $subject) {
            $msg->to($email)->subject($subject);
        });
    }
}
