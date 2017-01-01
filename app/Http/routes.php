<?php

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

Route::get('/','PostsController@index');

Route::auth();

Route::get('/home', 'HomeController@index');

Route::group(['middleware' => 'auth'], function () {
    Route::get('/posts/create', ['as' => 'post-create', 'uses' => 'PostsController@create']);
    Route::post('/posts/create', ['as' => 'post-create', 'uses' => 'PostsController@store']);
    Route::get('/posts/update/{id}', ['as' => 'post-update', 'uses' => 'PostsController@edit']);
    Route::post('/posts/update/{id}', ['as' => 'post-update', 'uses' => 'PostsController@update']);
    Route::post('/comments/create', ['as' => 'comment-create', 'uses' => 'CommentsController@store']);
    Route::get('/comments/update/{id}', ['as' => 'comment-update', 'uses' => 'CommentsController@edit']);
    Route::post('/comments/update/{id}', ['as' => 'comment-update', 'uses' => 'CommentsController@update']);
    Route::get('profile',['as' => 'my-profile','uses' => 'UsersController@profile']);
    Route::get('users',['as' => 'show-users','uses' => 'UsersController@show_users']);
    Route::get('user/{id}',['as' => 'get-user-profile','uses' => 'UsersController@get_user_profile']);
    Route::get('password/update',['as' => 'update-password','uses' => 'UsersController@edit_credentials']);
    Route::post('password/update',['as' => 'update-password','uses' => 'UsersController@update_credentials']);
});
/* * *********** posts  ******************* */
Route::get('/posts', 'PostsController@index');
Route::get('/posts/{id}', ['as' => 'post-details', 'uses' => 'PostsController@post']);
