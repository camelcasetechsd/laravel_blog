<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;
use App\Model\Post;

class StoreBlogPost extends Request
{

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
       
        switch ($this->method) {
            case "POST":
                return [
                    'title'   => 'required|unique:posts|max:255',
                    'content' => 'required',
                    'image'   => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                ];
                break;
            case "PATCH":
                return [
                    'title'   => 'required|max:255|unique:posts,title,' . $this->route('id'),
                    'content' => 'required',
                    'image'   => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                ];
                break;
        }
    }

}
