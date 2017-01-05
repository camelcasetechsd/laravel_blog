<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Model\User;
use Auth;
use Hash;

class UsersController extends Controller
{

    public function profile()
    {
        $user = Auth::user();
        Return view('users.myprofile', ['user' => $user]);
    }

    public function show_users()
    {
        $users = User::select('id', 'name')->paginate(10);
        return view('users.index', ['users' => $users]);
    }

    public function get_user_profile($id)
    {
        $user = User::where('id', $id)->first();
        return view('users.user-profile', ['user' => $user]);
    }

    public function edit_credentials()
    {
        $email = Auth::user()->email;
        return view('users.password-update', ['email' => $email]);
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
                $request->session()->flash('message', 'Password was updated successfully');
                $request->session()->flash('status', 'success');
            } else {
                $request->session()->flash('message', 'Error ,pleas try again');
                $request->session()->flash('status', 'danger');
            }
        } else {
            $request->session()->flash('message', ' Error ,pleas enter correct password ');
            $request->session()->flash('status', 'danger');
        }
        return back();
    }

}
