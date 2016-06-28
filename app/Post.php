<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{

    use SoftDeletes;

    /**
     * Setting table name (defualt)
     * @var string  
     */
    protected $table = 'posts';

    /**
     * enabling soft deleting
     * @var array 
     */
    protected $dates = ['deleted_at'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title', 'summary', 'content',
    ];

    /**
     * to get user from post
     * @param string $related Model name 
     * @param string $foreignKey foreign key flag 
     * @return type
     */
    public function author()
    {
        return $this->belongsTo('App\User', 'author_id');
    }

    /**
     * function to return post comments 
     * @return App\Comment
     */
    public function comments()
    {
        return $this->hasMany('App\Comment');
    }

}
