<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\User;
use Auth;
use Hash;

class UsersController extends Controller
{

    public function profile()
    {
        $user = Auth::user();
        Return view('website.myprofile', ['user' => $user]);
    }

    public function show_users()
    {
        $users = User::select('id', 'name')->paginate(10);
        return view('website.users', ['users' => $users]);
    }

    public function get_user_profile($id)
    {
        $user = User::where('id', $id)->first();
        return view('website.user-profile', ['user' => $user]);
    }

    public function edit_credentials()
    {
        $email = Auth::user()->email;
        return view('website.password-update', ['email' => $email]);
    }

    public function update_credentials(Request $request)
    {
        $user = User::find(auth()->user()->id);
        $this->validate($request, [
            'email'    => 'required|email|max:255|unique:users,email,' . $user->id,
            'password' => 'required|min:6|confirmed',
        ]);
        $input = $request->all();
        $input['password'] = bcrypt($input['password']);
        //check if old password was correct

        if (Hash::check($input['old_password'], $user->password)) {
            $updated = $user->update($input);
            if ($updated) {
                $request->session()->flash('message', '<div class = "alert alert-success">
                         <ul> <li> Password was updated successfully </li> </ul>
                         </div>');
            } else {
                $request->session()->flash('message', '<div class = "alert alert-danger">
                         <ul> <li> Error ,pleas try again </li> </ul>
                         </div>');
            }
        } else {
            $request->session()->flash('message', '<div class = "alert alert-danger">
                         <ul> <li> Error ,pleas enter correct password </li> </ul>
                         </div>');
        }
        return back();
    }

}
