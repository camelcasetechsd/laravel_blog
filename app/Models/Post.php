<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Utilities\UploadDirs;

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

    public function uploadImage($request)
    {
        return $this->imageUploader->upload($request, UploadDirs::ARTICLES_DIR);
    }

}
