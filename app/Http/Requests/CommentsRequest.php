<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;
use App\Model\Comment;

class CommentsRequest extends Request
{

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        $comment = Comment::find($this->route('id'));

        return $comment && ($this->user()->id == $comment->owner_id);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
           'content' => 'required',
        ];
    }

}
