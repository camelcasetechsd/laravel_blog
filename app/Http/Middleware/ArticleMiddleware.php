<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;

class ArticleMiddleware
{

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $article = Post::findOrFail($request->article);
        if ($article->author->id === Auth::user()->id) {
            return $next($request);
        }
        else {
            return response('Unauthorized', 401);
        }
    }

}
