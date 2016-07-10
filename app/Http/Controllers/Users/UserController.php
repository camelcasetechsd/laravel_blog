<?php

namespace App\Http\Controllers\Users;

use Illuminate\Http\Request;
use App\Http\Requests;
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

    public function updateImage(Requests\Request $request)
    {
        $user = Auth::user();
        $user->avatar = $user->updateUserImage($request);
        $user->save();
    }

}
