<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $table = 'comments';
    protected $fillable = ['owner_id','post_id','content'];
    public static $rules = [
        'content' => 'required',
    ];
}
