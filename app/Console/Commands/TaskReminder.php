<?php

namespace App\Console\Commands;

use App\Jobs\TaskJob;
use App\Models\Scopes\TaskScope;
use App\Models\User;
use Illuminate\Console\Command;

class TaskReminder extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'task:remind';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Reminds users of their daily tasks';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        $users = User::all();
        for ($a = 0; $a < $users->count(); $a++) {
            $tasks = $users[$a]->todayTasks;
            TaskJob::dispatch($users[$a], $tasks);
        }
    }
}
