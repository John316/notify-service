<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserStatusController extends Controller
{
    public function index()
    {
        $users = User::all();
        return view('users.index', compact('users'));
    }

    public function update(Request $request, User $user)
    {
        $request->validate([
            'telegram_id' => 'required|numeric|unique:users,telegram_id,' . $user->id,
            'subscribed' => 'required|boolean',
        ]);

        $user->update([
            'telegram_id' => $request->telegram_id,
            'subscribed' => $request->subscribed,
        ]);

        return redirect()->back()->with('success', 'Updated');
    }
}
