<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 
        'email',
        'password',
        'profile_image', 
    ];

    public function tweets()
    {
        return $this->hasMany(Tweet::class);
    }

    public function follows()
    {
        return $this->belongsToMany(User::class, 'follows', 'user_id', 'follower_id');
    }

    public function isFollowing(User $user)
    {
        return $this->follows()->where('follower_id', $user->id)->exists();
    }

    public function favorites()
    {
        return $this->hasMany(Favorite::class);
    }
}
