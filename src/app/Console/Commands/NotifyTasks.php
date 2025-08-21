<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;
use App\Models\User;
use App\Jobs\SendTelegramMessageJob;

class NotifyTasks extends Command
{
    protected $signature = 'notify:tasks';
    protected $description = 'Send active tasks to subscribed users';

    public function handle()
    {
        // receive list of the tasks from some api
        $tasks = Http::get('https://some.api.com/todos')->json();

        $activeTasks = collect($tasks)
            ->where('completed', false)
            ->where('userId', '<=', 5)
            ->values();

        $users = User::where('subscribed', true)->get();

        foreach ($users as $user) {
            $message = "Active tasks:\n";
            foreach ($activeTasks as $task) {
                $message .= "- {$task['title']}\n";
            }

            // Добавляем в очередь
            SendTelegramMessageJob::dispatch($user->telegram_id, $message);
        }

        $this->info('Notifications queued!');
    }
}
