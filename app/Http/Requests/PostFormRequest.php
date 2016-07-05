<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class PostFormRequest extends Request
{

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
//        return false;
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {

        switch ($this->method()) {
            case 'GET':
            case 'DELETE': {
                    return [];
                }
            case 'POST': {
                    return [
                        'title' => 'required|unique:posts|max:225',
                        'summary' => 'required',
                        'body' => 'required|max:1024',
                        'image' => 'required',
                    ];
                }
            case 'PUT':
            case 'PATCH': {
                    return [
                        'title' => 'required|unique:posts|max:225',
                        'summary' => 'required',
                        'body' => 'required|max:1024',
                            // image ignored in update
                    ];
                }
            default:break;
        }
    }

}
