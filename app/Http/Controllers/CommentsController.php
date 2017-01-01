<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Requests\CommentsRequest;
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

    public function edit($id)
    {
        $comment = Comment::find($id);
        return view('website.comment-update', ['comment' => $comment]);
    }

    public function update(CommentsRequest $request, $id)
    {
        $comment = Comment::find($id);
        $updated = $comment->update($request->all());
        if ($updated) {
            return redirect()->route('post-details', ['id' => $comment->post_id]);
        }
        $request->session()->flash('message', '<div class = "alert alert-danger">
                         <ul> <li> Error ,pleas enter correct password </li> </ul>
                         </div>');
        return back();
    }

}
