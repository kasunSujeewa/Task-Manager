<?php

namespace App\Console\Commands;

use App\Jobs\sendNotifyEmailForTaskDue;
use App\Models\Task;
use Illuminate\Console\Command;

class DueTaskNotifier extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'due-task-notifier:cron';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $from = date('Y-m-d');
        $search_date = date('Y-m-d', strtotime($from. ' + 1 days'));
        $tasks = Task::whereDate('due_date',$search_date)->get();
        
        if(count($tasks)>0){
            foreach ($tasks as  $task) {
                sendNotifyEmailForTaskDue::dispatch($task);
            }
        }
    }
}
