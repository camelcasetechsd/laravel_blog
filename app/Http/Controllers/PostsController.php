<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Requests\StoreBlogPost;
use App\Model\Post;
use Auth;
use File;
use PDF;
use FORM;

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
        return view('posts.create',[
            'post' => new Post,
            'route' => 'post-create'
        ]);
    }

    /**
     * store post
     */
    public function store(Request $request)
    {
        $this->validate($request, Post::$rules);
        $user = Auth::user();
        $input = $request->all();
        if ($request->hasFile('image') &&$request->file('image')->isValid()) {
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
            return redirect()->route('post-details', ['id' => $post->id]);
        } else {
            $request->session()->flash('message', '<div class = "alert alert-danger">
                         <ul> <li> Error ,pleas try again </li> </ul>
                         </div>');
        }
        return back()->withInput();
    }

    public function edit($id)
    {
        $post = Post::find($id);
        return view('posts.create', [
            'post' => $post,
            'route' => 'post-update',
            ]);
    }

    public function update(StoreBlogPost $request, $id)
    {
        $post = Post::find($id);
        $old_image = $post->image;
        $input = $request->all();
        if ($request->hasFile('image') && $request->file('image')->isValid()) {
            $input['image'] = $this->image_upload($request);
        }
        $input ['owner_id'] = Auth::user()->id;
        $updated = $post->update($input);
        if ($updated) {
            if ($old_image && !empty($input['image'])) {
                File::delete(public_path('postspics/' . $old_image));
            }
            $request->session()->flash('message', '<div class = "alert alert-success">
                         <ul> <li> Post was updated successfully </li> </ul>
                         </div>');
            return redirect()->route('post-details', ['id' => $post->id]);
        } else
            return back()->withInput();
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

    public function pdf($id)
    {
        $post = Post::find($id);
        //dd($post->toArray());
        $pdf = PDF::loadView('website.pdf',$post->toArray());
        return $pdf->download($post->title .'.pdf');
    }

}
