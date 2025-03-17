<?php

namespace App\Console;

use App\Console\Commands\ImportOpenFoodData;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    protected $commands = [
        ImportOpenFoodData::class,
    ];

    protected function schedule(Schedule $schedule)
    {
        $schedule->command('import:open-food-data')
             ->dailyAt(config('import.import_schedule.hour') . ':' . config('import.import_schedule.minute'));
    }

    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
