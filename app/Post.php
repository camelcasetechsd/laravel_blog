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

}
