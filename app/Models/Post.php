<?php

namespace App\Models;

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
        'title', 'summary', 'body',
    ];

    /**
     * to get user from post
     * @param string $related Model name 
     * @param string $foreignKey foreign key flag 
     * @return type
     */
    public function author()
    {
        return $this->belongsTo('App\Models\User', 'author_id');
    }

    /**
     * function to return post comments 
     * @return App\Models\Comment
     */
    public function comments()
    {
        return $this->hasMany('App\Models\Comment')->orderBy('created_at', 'desc');
    }

    public static function uploadImage($request)
    {
        $file = $request->image;
        $imageName = bin2hex(random_bytes(10)) . '.' . $request->file('image')->getClientOriginalExtension();
        $imagePath = '/images/articles/';
        $containerPath = public_path() . $imagePath;
        $file->move($containerPath, $imageName);
        return $imagePath . $imageName;
    }

}
