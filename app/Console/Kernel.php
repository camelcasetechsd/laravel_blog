<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        // Commands\Inspire::class,
         Commands\DropTables::class,
         Commands\GoodMorningMail::class
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        /**
         * adding  a cron with the following command to check if there's jobs
         * needed to be pushed to the queue each min
         *   * * * * * php /path/to/artisan schedule:run >> /dev/null 2>&1
         *
         * 
         * to run all jobs saved in DB Run :
         * php artisan queue:work --daemon 
         *
         * NOTE : queue:work --daemon is better than queue:listen 
         * cause it saves CPU usage
         *
         */
        
        $schedule->command('goodmorning-user')->daily();
    }
}
