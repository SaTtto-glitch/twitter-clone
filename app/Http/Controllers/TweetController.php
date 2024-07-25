<?php

namespace App\Http\Controllers;

use App\Models\Tweet;
use Illuminate\Http\Request;

class TweetController extends Controller
{
    public function index()
    {
        $tweets = Tweet::with('user')->latest()->get();
        return view('tweets.index', compact('tweets'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'body' => 'required|max:255',
        ]);

        $request->user()->tweets()->create([
            'body' => $request->input('body'),
        ]);

        return redirect()->route('tweets.index');
    }
}

