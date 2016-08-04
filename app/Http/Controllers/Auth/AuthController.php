<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
use App\Models\Post;
use App\Utilities\UploadDirs;
use Illuminate\Support\Facades\Input;

class AuthController extends Controller
{
    /*
      |--------------------------------------------------------------------------
      | Registration & Login Controller
      |--------------------------------------------------------------------------
      |
      | This controller handles the registration of new users, as well as the
      | authentication of existing users. By default, this controller uses
      | a simple trait to add these behaviors. Why don't you explore it?
      |
     */

use AuthenticatesAndRegistersUsers,
    ThrottlesLogins;

    /**
     * Guard 
     * @var string 
     */
//    protected $guard = 'admin';

    /**
     * validate with username field
     */
    const LOGIN_USERNAME_TYPE_USERNAME_TEXT = 'username';

    /**
     * validate with emial field
     */
    const LOGIN_USERNAME_TYPE_EMAIL_TEXT = 'email';

    /**
     * Where to redirect users after login / registration.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware($this->guestMiddleware(), ['except' => 'logout']);
    }

    /**
     * Get the login username to be used by the controller.
     *
     * @return string
     */
    public function loginUsername()
    {
        return property_exists($this, 'username') ? $this->username : self::LOGIN_USERNAME_TYPE_USERNAME_TEXT;
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
//validators
                    'username' => 'required|max:255|unique:users',
                    'name' => 'required|max:255',
                    'email' => 'required|email|max:255|unique:users',
                    'password' => 'required|min:6|confirmed',
                    'dob' => 'date',
                    'city' => 'required|max:20',
                    'telephone' => 'required|min:7|max:20',
                    'address' => 'required|min:20|max:255',
                    'avatar' => 'mimes:jpg,gif,jpeg,png|size:5000',
                        ], [
// messages
                    'mimes' => 'your :attribute \'s extension should be jpg,gif,jpeg,png',
                    'size' => 'Image must not exceed 5 MB'
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {
        $uploadProcess = function () {
            if (!is_null(Input::get('image'))) {
                $request = app('request');
                $imageUploader = app()->make('App\Models\ImageUploader');
                return $imageUploader->upload($request, UploadDirs::AVATARS_DIR);
            }
            else {
                $user = app()->make('App\Models\User');
                return UploadDirs::AVATARS_DIR . $user::DEFAULT_USER_IMAGE;
            }
        };

        return User::create([
                    'username' => $data['username'],
                    'name' => $data['name'],
                    'email' => $data['email'],
                    'password' => bcrypt($data['password']),
                    'dob' => $data['dob'],
                    'city' => $data['city'],
                    'telephone' => $data['telephone'],
                    'address' => $data['address'],
                    'avatar' => $uploadProcess()
        ]);
    }

}
