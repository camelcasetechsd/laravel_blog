<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'username', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * function returns user's posts
     * @param string $related Model Name
     * @return type
     */
    public function posts()
    {
        return $this->hasMany('App\Models\Post');
    }
    /**
     * function to return user comments 
     * @return App\Models\Comment
     */
    public function comments()
    {
        return $this->hasMany('App\Models\Comment');
    }

}
