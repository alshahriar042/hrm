<?php

namespace App\Console\Commands;

use Carbon\Carbon;
use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class PopulateUserRecord extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'user:record';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Populate attendance table with all users for a specific date';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
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
        $this->info('Attendance table populated with user data  for ' . $date);
    }
}
