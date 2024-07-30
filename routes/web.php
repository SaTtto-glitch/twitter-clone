<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TweetController;
use App\Http\Controllers\FollowController;
use App\Http\Controllers\FavoriteController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\RedirectIfAuthenticated;

Route::get('/', function () {
    return view('welcome');
})->middleware(RedirectIfAuthenticated::class);



Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::patch('/profile/updateProfileImage', [ProfileController::class, 'updateProfileImage'])->name('profile.updateProfileImage');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/home', [TweetController::class, 'index'])->name('tweets.index');
    Route::post('/home', [TweetController::class, 'store'])->name('tweets.store');

    Route::post('/follow/{user}', [FollowController::class, 'store'])->name('follow.store');
    Route::delete('/follow/{user}', [FollowController::class, 'destroy'])->name('follow.destroy');

    Route::get('/users/{user}', [UserController::class, 'show'])->name('users.show');

    Route::post('/favorite/{tweetId}', [FavoriteController::class, 'store'])->name('favorite.store');
    Route::delete('/favorite/{tweetId}', [FavoriteController::class, 'destroy'])->name('favorite.destroy');

    
});

require __DIR__.'/auth.php';

