<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Auth;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'slug', 'avatar'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function posts()
    {
        return $this->hasMany(Post::class);
    }

    public function adminPosts()
    {
        switch ($this->role) {
            case "admin":
            case "editor":
                $posts = Post::latest()->paginate(20);
                break;
            case "author":
                $posts = Post::where('user_id', Auth::id())->paginate(20);
                break;
        }

        return $posts;
    }
}
