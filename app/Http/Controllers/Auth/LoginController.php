<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Auth;
use Illuminate\Http\Request;

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

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function logout(Request $request)
    {
        if(Auth::guard('admin'))
        {
            Auth::guard('admin')->logout();
            $request->session()->flush();
            $request->session()->regenerate();
            return redirect('login');
        }
        if(Auth::guard('staff'))
        {
            Auth::guard('staff')->logout();
            $request->session()->flush();
            $request->session()->regenerate();
            return redirect('login');
        }
        if(Auth::guard('student'))
        {
            Auth::guard('student')->logout();
            $request->session()->flush();
            $request->session()->regenerate();
            return redirect('login');
        }
    }
}
