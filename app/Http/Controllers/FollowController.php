<?php

namespace App\Http\Controllers;

use App\Models\Follow;
use Illuminate\Http\Request;

class FollowController extends Controller
{
    public function store(Request $request, $id)
    {
        $request->user()->follows()->create([
            'follower_id' => $id,
        ]);

        return back();
    }

    public function destroy(Request $request, $id)
    {
        $request->user()->follows()->where('follower_id', $id)->delete();

        return back();
    }
}

