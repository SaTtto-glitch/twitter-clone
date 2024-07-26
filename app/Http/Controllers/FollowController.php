<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;

class FollowController extends Controller
{
    public function store(User $user)
    {
        Auth::user()->follows()->attach($user->id);

        return redirect()->back();
    }

    public function destroy(User $user)
    {
        Auth::user()->follows()->detach($user->id);

        return redirect()->back();
    }
}





