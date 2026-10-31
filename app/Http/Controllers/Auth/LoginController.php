<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    public function showLoginForm()
    {
        return redirect()->route('home')->with('openLoginModal', true);
    }

    public function username()
    {
        return 'login';
    }

    protected function attemptLogin(Request $request)
    {
        $identifier = $request->input($this->username());
        $user = User::where('email', $identifier)->first();

        if (!$user) {
            $user = User::where('name', $identifier)->first();
        }

        if (!$user || !Hash::check($request->input('password'), $user->password)) {
            return false;
        }

        $this->guard()->login($user, $request->boolean('remember'));

        return true;
    }

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
}
