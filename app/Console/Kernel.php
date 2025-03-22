<?php

namespace App\Console;

use App\Models\Task;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    protected function schedule(Schedule $schedule)
    {
        $schedule->call(function () {
            $tasks = Task::where('date_echeance', '>=', now())
                ->where('date_echeance', '<=', now()->addHours(24))
                ->where('completed', false)
                ->get();

            foreach ($tasks as $task) {
                $task->user->notify(new \App\Notifications\TaskReminder($task));
            }
        })->daily();
    }

    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}