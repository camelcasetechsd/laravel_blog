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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/new-article', function() {
    $users = App\User::all()->pluck('username', 'id');
    return view('new_articale', compact('users', $users));
});

Route::post('/new-article', function ( PostFormRequest $request) {
    $post = new App\Post();
    
    $file = Input::file('image');
    $imageName = bin2hex(random_bytes(10)) . '.' . $request->file('image')->getClientOriginalExtension();
    $imagePath = base_path() . '/public/images/articles/';
    $file->move($imagePath,$imageName);

    $post->author_id = $request->username;
    $post->title = $request->title;
    $post->summary = $request->summary;
    $post->content = $request->content;
    $post->image = $imagePath.$imageName;

    $post->save();



    return redirect()->route('feed');
});

Route::get('/post/{postId}', function($postId) {
    $post = App\Post::find($postId);
    return view('post', array('post' => $post));
});

Route::get('/feed', ['as' => 'feed', function() {
        $posts = App\Post::orderBy('created_at', 'desc')->get();
        return view('feed', array('posts' => $posts));
    }]);

        Route::get('/register', function() {
            return view('register');
        });
        