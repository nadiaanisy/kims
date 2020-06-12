<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Password;

class SForgotPasswordController extends Controller
{
    
    use SendsPasswordResetEmails;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest:student');
    }

    protected function broker()
    {
    	return Password::broker('students');
    }
    public function showLinkRequestForm()
    {
        return view('auth.passwords.emails');
    }
}
