<?php

namespace App\Http\Controllers\Articles;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests;
use Illuminate\Auth\Access\Gate as Gate;
use App\Models\Post as Post;
use App\Models\User as User;
use App\Models\Comment as Comment;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
//use Barryvdh\DomPDF\PDF;
use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Support\Facades\URL as URL;

class ArticleController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $articles = Post::orderBy('created_at', 'desc')->paginate(10);
        return view('articles.index', array(
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
        return view('articles.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        /**
         * Validating article data
         */
        $this->validate($request, [
            'title' => 'required|unique:posts|max:225',
            'summary' => 'required',
            'content' => 'required|max:1024',
            'summary' => 'required',
            'image' => 'required',
        ]);

        $post = new Post();

        $file = $request->image;
        $imageName = bin2hex(random_bytes(10)) . '.' . $request->file('image')->getClientOriginalExtension();
        $imagePath = '/images/articles/';
        $containerPath = public_path() . $imagePath;
        $file->move($containerPath, $imageName);
        $post->author_id = Auth::user()->id;
        $post->title = $request->title;
        $post->summary = $request->summary;
        $post->content = $request->content;
        $post->image = $imagePath . $imageName;
        $post->save();

        $user = Auth::user();
//        Mail::send('mails.new_article', ['user' => $user], function ($m) use ($user) {
//            $m->from('hello@app.com', 'Your Application');
//
//            $m->to($user->email, $user->name)->subject('Your Reminder!');
//        });
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
        return view('articles.show', array(
            'post' => $post,
        ));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        
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
        
    }

    public function pdf($id)
    {
        $article = Post::find($id);
        $pdf = PDF::loadView('download.pdf', array(
            'title'=>$article->title,
            'created_at'=>$article->created_at,
            'author'=>$article->author->name,
            'content'=>$article->content,
            'image'=>URL::to('/').$article->image,
        ));
        return $pdf->download($article->title.'.pdf');
    }

}
