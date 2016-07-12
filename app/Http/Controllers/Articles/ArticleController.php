<?php

namespace App\Http\Controllers\Articles;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\View;
use App\Http\Requests\PostFormRequest;
use App\Models\Post as Post;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Support\Facades\URL as URL;
use App\Utilities\Settings;
use App\Utilities\Mails\MailSubjects;
use App\Utilities\Mails\MailTemplates;
use Illuminate\Support\Facades\Event;
use App\Events\ArticleCreateEvent;

class ArticleController extends Controller
{

    public function __construct()
    {
        $this->middleware('article', array(
            'only' => array(
                'edit',
                'update'
            )
        ));
    }

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
    public function store(PostFormRequest $request)
    {
        $post = new Post();
        $post->author_id = Auth::user()->id;
        $post->title = $request->title;
        $post->summary = $request->summary;
        $post->body = $request->body;
        $post->image = $post->uploadImage($request);
        $post->save();
        /**
         *  firing Article Creation Event which sends a welcome mail
         *  Used as Event to be able to ignore it while tesing with phpunit
         */
        Event::fire(new ArticleCreateEvent($post));
        // falsh message
        $request->session()->flash('status-success', 'Created Successfully!');
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

        $post = Post::findOrFail($id);
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
        $article = Post::findOrFail($id);
        return View::make('articles.create')->with(compact('article'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PostFormRequest $request, $id)
    {
        $article = Post::findOrFail($id);
        $post = new Post();
        $article->title = $request->title;
        $article->summary = $request->summary;
        $article->body = $request->body;
        if (!is_null($request->image)) {
            $article->image = $post->uploadImage($request);
        }
        $article->save();

        return view('articles.show', array('post' => $article));
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
        $article = Post::findOrFail($id);
        $pdf = PDF::loadView('download.pdf', array(
                    'title' => $article->title,
                    'created_at' => $article->created_at,
                    'author' => $article->author->name,
                    'body' => $article->body,
                    'image' => URL::to('/') . $article->image,
        ));
        return $pdf->download($article->title . '.pdf');
    }

}
