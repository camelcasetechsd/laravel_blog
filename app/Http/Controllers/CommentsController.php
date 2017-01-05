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
        return view('posts.comments.comment-update', [
            'comment' => $comment,
             'route' => 'comment-update']);
    }

    public function update(CommentsRequest $request, $id)
    {
        $comment = Comment::find($id);
        if ($comment->owner_id != Auth::user()->id) {
            $request->session()->flash('message', " Error ,You don't have permission to update this comment");
            $request->session()->flash('status', 'danger');
            return back();
        }
        $updated = $comment->update($request->all());
        if ($updated) {
            return redirect()->route('post-details', ['id' => $comment->post_id]);
        }
        $request->session()->flash('message', 'Error ,pleas try again');
         $request->session()->flash('status', 'danger');
        return back();
    }

}
