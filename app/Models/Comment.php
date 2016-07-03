<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{

    /**
     * Table Name
     * @var string 
     */
    protected $table = 'comments';

    /**
     * The attributes that are mass assignable.
     * @var type 
     */
    protected $fillable = array(
        'comment',
    );

    public function post()
    {
        return $this->belongsTo('App\Models\Post');
    }

    /**
     * function to return user  
     * @return App\Models\User
     */
    public function commenter()
    {
        return $this->belongsTo('App\Models\User','user_id','id');
    }

}
