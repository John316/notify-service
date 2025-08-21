<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserStatusController;

Route::get("/", function () {
    return view("welcome");
});

Route::get('/users', [UserStatusController::class, 'index'])->name('users.index');
Route::put('/users/{user}', [UserStatusController::class, 'update'])->name('users.update');
