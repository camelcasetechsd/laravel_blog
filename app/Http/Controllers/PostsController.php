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
        return view('posts.create');
    }

    /**
     * store post
     */
    public function store(StoreBlogPost $request)
    {
        $user = Auth::user();
        $input = $request->all();
        if ($request->hasFile('image') && $request->file('image')->isValid()) {
            $image = $request->file('image');
            $filename = time() . '.' . $image->getClientOriginalExtension();
            $path = public_path('postspics/');
            $request->file('image')->move($path, $filename);
            $input['image'] = $filename;
        }
        $input ['owner_id'] = $user->id;
        $post = Post::create($input);
        if ($post) {
            $request->session()->flash('message', ' Post was created successfully');
            $request->session()->flash('status', 'success');
            return redirect()->route('post-details', ['id' => $post->id]);
        } else {
            $request->session()->flash('message', ' Error ,pleas try again ');
            $request->session()->flash('status', 'danger');
        }
        return back()->withInput();
    }

    public function edit($id)
    {
        $post = Post::find($id);
        return view('posts.update', [
            'post' => $post,
        ]);
    }

    public function update(StoreBlogPost $request, $id)
    {
        $post = Post::find($id);
        if (Auth::user()->id != $post->owner_id) {
            $request->session()->flash('message', " Error ,You don't have permission to update this post");
            $request->session()->flash('status', 'danger');
            return back();
        }
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
            $request->session()->flash('message', ' Post was updated successfully 
                         ');
            $request->session()->flash('status', 'success');
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
        return view('posts.index', ['post' => $post]);
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
        $pdf = PDF::loadView('website.pdf', $post->toArray());
        return $pdf->download($post->title . '.pdf');
    }

}
