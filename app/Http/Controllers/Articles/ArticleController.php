<?php

namespace App\Http\Controllers\Articles;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests;
use Illuminate\Auth\Access\Gate as Gate;
use App\Post as Post;
use App\User as User;

//use Illuminate\Support\Facades\Request 

class ArticleController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $articles = Post::orderBy('created_at', 'desc')->get();
        return view('articles.feed', array(
            'articles' => $articles
        ));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
//        if (Gate::denies('access_create_post'))
//        {
//            abort(403);
//        }
        $users = User::all()->pluck('username', 'id');
        return view('articles.new_articale', compact('users', $users));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $post = new Post();

        $file = $request->image;
        $imageName = bin2hex(random_bytes(10)) . '.' . $request->file('image')->getClientOriginalExtension();
        $imagePath = '/images/articles/';
        $containerPath = base_path() .'/public/'. $imagePath;
        $file->move($containerPath, $imageName);
        $post->author_id = $request->username;
        $post->title = $request->title;
        $post->summary = $request->summary;
        $post->content = $request->content;
        $post->image = $imagePath . $imageName;
        $post->save();
        // redirect 
        return redirect()->route('article.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post = Post::find($id);
        return view('articles.post', array('post' => $post));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

}
