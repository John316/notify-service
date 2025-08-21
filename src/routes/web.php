<?php

use Illuminate\Support\Facades\Route;

Route::get("/", function () {
    return view("welcome");
});

use App\Http\Controllers\TelegramWebhookController;

Route::post('/telegram/webhook', [TelegramWebhookController::class, 'handle']);
