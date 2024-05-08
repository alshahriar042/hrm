<?php

namespace App\Console;

use App\Console\Commands\AttendanceProcces;
use Illuminate\Console\Scheduling\Schedule;
use App\Console\Commands\PopulateUserRecord;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    protected $commands = [
       PopulateUserRecord::class,
       AttendanceProcces::class,
    ];
    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        $schedule->command('user:record')->hourlyAt(6) ->skip(function () {
            return in_array(date('l'), ['Friday', 'Saturday']);
        });


        $schedule->command('attendence:process')
             ->everyThirtyMinutes()
             ->skip(function () {
                 return in_array(date('l'), ['Friday', 'Saturday']);
             });

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
