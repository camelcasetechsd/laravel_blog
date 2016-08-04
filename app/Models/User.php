<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Utilities\UploadDirs;

class User extends Authenticatable
{

    const DEFAULT_USER_IMAGE = 'default.png';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'username', 'email', 'password', 'avatar', 'address', 'city', 'telephone', 'dob'
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
     * Imageuploader calss 
     * @var App\Models\ImageUploader 
     */
    protected $imageUploader;

    public function __construct(array $attributes = array())
    {
        parent::__construct($attributes);
        $this->imageUploader = app()->make('App\Models\ImageUploader');
    }

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

    public function updateUserImage($request)
    {
        return $this->imageUploader->upload($request, UploadDirs::AVATARS_DIR);
    }

}
