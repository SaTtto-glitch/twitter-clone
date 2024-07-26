<?php

namespace App\Http\Controllers;

use App\Models\Favorite;
use Illuminate\Http\Request;

class FavoriteController extends Controller
{
    public function store(Request $request, $tweetId)
    {
        $request->user()->favorites()->create([
            'tweet_id' => $tweetId,
        ]);

        return back();
    }

    public function destroy(Request $request, $tweetId)
    {
        $request->user()->favorites()->where('tweet_id', $tweetId)->delete();

        return back();
    }
}

