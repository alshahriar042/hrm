<?php

namespace App\Console;

use App\Console\Commands\AttendanceProcces;
use App\Console\Commands\CheckAttendance;
use Illuminate\Console\Scheduling\Schedule;
use App\Console\Commands\PopulateUserRecord;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    protected $commands = [
       PopulateUserRecord::class,
       AttendanceProcces::class,
       CheckAttendance::class,
    ];
    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        $schedule->command('user:record')->dailyAt('07:00')
        	 ->skip(function () {
            return in_array(date('l'), ['Friday', 'Saturday']);
        });



        $schedule->command('attendence:process')
        ->everyFifteenMinutes()
        ->skip(function () {
            return in_array(date('l'), ['Friday', 'Saturday']);
        })
        ->when(function () {
            $currentTime = now()->format('H:i');
            return $currentTime >= '10:00' && $currentTime <= '23:00';
        });

        // $schedule->command('attendance:check')->everyFiveSeconds();

        $schedule->command('attendance:check')
        ->everyMinute();

    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
