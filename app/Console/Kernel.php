<?php

namespace App\Console;

use App\Jobs\StravaActivityCall;
use App\User;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use NerdRunClub\Calculation;
use NerdRunClub\Request;

class Kernel extends ConsoleKernel
{
    protected $u;
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        //
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        // $schedule->command('inspire')
        //          ->hourly();
        $users = User::all();

        foreach ($users as $u){
            $this->u = $u;
                $schedule->call(function () {
                    StravaActivityCall::dispatch($this->u);
                })->everyFifteenMinutes();
        }

        $schedule->call(function (Calculation $calculation){
            $calculation->saveMedals();
        })->weeklyOn(7, '23:59');
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
