<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Services\TelegramService;
use Illuminate\Support\Facades\Log;

class TelegramWebhookController extends Controller
{
    public function handle(Request $request, TelegramService $telegram)
    {
        try {
            $update = $request->all();

            if (!isset($update['message'])) {
                return response()->json(['status' => 'no message']);
            }

            $chatId = $update['message']['chat']['id'];
            $text = $update['message']['text'] ?? '';

            if ($text === '/start') {
                User::updateOrCreate(
                    ['telegram_id' => $chatId],
                    ['name' => $update['message']['from']['first_name'], 'subscribed' => true]
                );

                $telegram->sendMessage($chatId, "You subscribed ✅");
            }

            if ($text === '/stop') {
                $user = User::where('telegram_id', $chatId)->first();
                if ($user) {
                    $user->subscribed = false;
                    $user->save();
                    $telegram->sendMessage($chatId, "You unsubscribed ❌");
                }
            }
        } catch (\Exception $e) {
            Log::error('Webhook error: ' . $e->getMessage());
        }

        return response()->json(['status' => 'ok']);
    }
}
