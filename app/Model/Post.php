<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{

    protected $table = 'posts';
    protected $fillable = ['owner_id', 'title', 'content', 'image_id', 'image', 'thumb'];
    public static $rules = [
        'title'   => 'required|unique:posts|max:255',
        'content' => 'required',
        'image'   => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
    ];

    public function Comments()
    {
        return $this->hasMany('App\Model\Comment');
    }

    public function User()
    {
        return $this->belongsTo('App\Model\User', 'owner_id');
    }

}
