<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Model\Comment;
use Auth;

class CommentsController extends Controller
{

    public function store(Request $request)
    {
        $this->validate($request, Comment::$rules);
        $user = Auth::user();
        $input = $request->all();
        $input ['owner_id'] = $user->id;
        $comment = Comment::create($input);

        return back();
    }

}
