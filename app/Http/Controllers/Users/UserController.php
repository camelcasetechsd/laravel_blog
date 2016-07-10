<?php

namespace App\Http\Controllers\Users;

use App\Http\Requests\ImageFormRequest;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{

    public function profile()
    {
        $user = Auth::user();
        return view('users.profile', array(
            'user' => $user
        ));
    }

        public function updateImage(ImageFormRequest $request)
    {
        $user = Auth::user();
        $user->avatar = $user->updateUserImage($request);
        $user->save();
        return view('users.profile', array(
            'user' => $user
        ));
    }

}
