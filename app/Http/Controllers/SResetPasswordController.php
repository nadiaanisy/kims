<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Http\Request;
use Password;
use Auth;
use DB;

class SResetPasswordController extends Controller
{
     /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset requests
    | and uses a simple trait to include this behavior. You're free to
    | explore this trait and override any methods you wish to tweak.
    |
    */

    use ResetsPasswords;

    /**
     * Where to redirect users after resetting their password.
     *
     * @var string
     */
    protected $redirectTo = 'logout'; //sementara

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest:student');
    }

    protected function guard()
    {
        return Auth::guard('student');
    }

    protected function broker()
    {
        return Password::broker('students');
    }    

    public function showResetForm(Request $request, $token = null)
    {
        
        return view('auth.passwords.resets')->with(
            ['token' => $token, 'email' => $request->email]
        );
    }
}