<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\User;
use App\Users;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
use Laravel\Socialite\Contracts\Factory as Socialite;

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

    use AuthenticatesAndRegistersUsers, ThrottlesLogins;

    /**
     * Where to redirect users after login / registration.
     *
     * @var string
     */
    protected $redirectTo = '/';

    protected $socialite;

    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct(Socialite $socialite)
    {
        $this->socialite = $socialite;
        $this->middleware('guest', ['except' => 'logout']);
    }

    public function getSocialAuth($provider=null)
    {
        if(!config("services.$provider")) abort('404');

        return $this->socialite->with($provider)->redirect();
    }


    public function getSocialAuthCallback($provider=null,Request $request)
    {
        if(!config("services.$provider")) abort('404');
        if($userData = $this->socialite->with($provider)->user()){
            $users = new Users();
            $user = new User($userData);
            $user = $users->save($user);
            \Auth::login($user, false);
            if($request->session()->get('next_page')) {
                return redirect($request->session()->pull('next_page'));
            }
            return redirect('/');
        } else {
            return abort('404');
        }
    }

    public function logout() {
        \Auth::logout();
        return redirect('/');
    }
}
