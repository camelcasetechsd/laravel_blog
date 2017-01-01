<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Requests\StoreBlogPost;
use App\Model\Post;
use Auth;
use File;

class PostsController extends Controller
{

    /**
     * return all posts
     */
    public function index()
    {
        $posts = Post::paginate(15);
        return view('website.index', ['posts' => $posts]);
    }

    /**
     * return create post view
     */
    public function create()
    {
        return view('posts.create');
    }

    /**
     * store post
     */
    public function store(Request $request)
    {
        $this->validate($request, Post::$rules);
        $user = Auth::user();
        $input = $request->all();
        if ($request->file('image')->isValid()) {
            $image = $request->file('image');
            $filename = time() . '.' . $image->getClientOriginalExtension();
            $path = public_path('postspics/');
            $request->file('image')->move($path, $filename);
            $input['image'] = $filename;
        }
        $input ['owner_id'] = $user->id;
        $post = Post::create($input);
        if ($post) {
            $request->session()->flash('message', '<div class = "alert alert-success">
                         <ul> <li> Post was created successfully </li> </ul>
                         </div>');
        } else {
            $request->session()->flash('message', '<div class = "alert alert-danger">
                         <ul> <li> Error ,pleas try again </li> </ul>
                         </div>');
        }
        return back();
    }

    public function edit($id)
    {
        $post = Post::find($id);
        return view('posts.update', ['post' => $post]);
    }

    public function update(StoreBlogPost $request, $id)
    {
        $post = Post::find($id);
        $old_image = $post->image;
        $input = $request->all();
        if ($request->file('image')->isValid()) {
        $input['image'] = $this->image_upload($request);
        }
        $input ['owner_id'] = Auth::user()->id;
        $updated = $post->update($input);
        if ($updated) {
            if ($old_image && $input['image']) {
                File::delete(public_path('postspics/' . $old_image));
            }
            return redirect()->route('post-details', ['id' => $post->id]);
           
        } else
            return back();
    }

    /**
     * get post details
     */
    public function post($id)
    {
        $post = Post::find($id);
        //dd($post->Comments);
        return view('website.post', ['post' => $post]);
    }

    public function image_upload($request)
    {
        $filename = time() . '.' . $request->file('image')->getClientOriginalExtension();
        $path = public_path('postspics/');
        $request->file('image')->move($path, $filename);
        return $filename;
    }

}
