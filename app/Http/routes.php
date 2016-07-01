<?php

use App\Http\Requests\PostFormRequest;

/*
  |--------------------------------------------------------------------------
  | Application Routes
  |--------------------------------------------------------------------------
  |
  | Here is where you can register all of the routes for an application.
  | It's a breeze. Simply tell Laravel the URIs it should respond to
  | and give it the controller to call when that URI is requested.
  |
 */
/**
 * Welcome page
 */
Route::get('/', 'Controller@welcome');

/**
 * authetication routes
 */
Route::auth();

/**
 * Home page 
 */
Route::get('/home', 'HomeController@index');


/**
 * Routes need authenticated Login
 */
Route::group(['middleware' => 'auth'], function() {

    /**
     * Article Create & Store & Update routes need authentication
     * Articles Index & Show are for Guests    
     */
    Route::resource('article', 'Articles\ArticleController', array(
        'only' => array('create', 'store', 'edit', 'update', 'destroy')
    ));

    Route::resource('comment', 'Comments\CommentsController', array(
        'only' => array('store', 'update')
    ));
});

Route::resource('article', 'Articles\ArticleController', array(
    'only' => array('index', 'show')
));

