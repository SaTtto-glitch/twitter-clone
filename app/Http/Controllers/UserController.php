<?php

namespace App\Http\Controllers;

use App\Models\User;

class UserController extends Controller
{
    public function show(User $user)
    {
        $tweets = $user->tweets()->latest()->get();
        return view('users.show', compact('user', 'tweets'));
    }
}
