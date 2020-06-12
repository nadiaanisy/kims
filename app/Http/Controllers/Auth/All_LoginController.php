<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Auth;
use Route;
use Illuminate\Support\MessageBag;

class All_LoginController extends Controller
{
    use AuthenticatesUsers;

    public function __construct()
    {
    	$this->middleware('guest:student', ['except' => ['logout']]);
    	$this->middleware('guest:staff', ['except' => ['logout']]);
      	$this->middleware('guest:admin', ['except' => ['logout']]);
    }

    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
    	// Validate the form data
      	$this->validate($request, [
        	'id'   => 'required',
        	'password' => 'required|min:1'
      	]);
        
      	// Attempt to log the user in
      	if(Auth::guard('admin')->attempt(['id' => $request->id, 'password' => $request->password, 'isAdmin' => 1], $request->remember))
      	{
      		return redirect()->intended(route('admin.dashboard'));
      	}
      	else if(Auth::guard('staff')->attempt(['id' => $request->id, 'password' => $request->password, 'isAdmin' => 0], $request->remember))
      	{
      		return redirect()->intended(route('staff.dashboard'));
      	}
      	if(Auth::guard('student')->attempt(['id' => $request->id, 'password' => $request->password], $request->remember))
      	{
      		return redirect()->intended(route('student.dashboard'));
      	}
      	// if unsuccessful, then redirect back to the login with the form data
      	$errors = new MessageBag;
        $errors = new MessageBag(['id' => ['These credential doesnt match our records.']
                                 ,'password' => ['The password entered might be wrong. ']]);
        return redirect()->back()->withErrors($errors)->withInput($request->only('id'));
    }

    public function logout(Request $request)
    {
        if(Auth::guard('admin'))
        {
            Auth::guard('admin')->logout();
            $request->session()->flush();
            $request->session()->regenerate();
            return redirect('/');
        }
        if(Auth::guard('staff'))
        {
            Auth::guard('staff')->logout();
            $request->session()->flush();
            $request->session()->regenerate();
            return redirect('/');
        }
        if(Auth::guard('student'))
        {
            Auth::guard('student')->logout();
            $request->session()->flush();
            $request->session()->regenerate();
            return redirect('/');
        }
    }
}
