<?php

namespace App\Http\Controllers\authentications;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginBasic extends Controller
{

  public function index()
  {
    return view('content.auth.login');
  }

  public function login (Request $request)
  {
    // $credentials = $request->only('username', 'password');

    // if(Auth::attempt($credentials)){
    //   return redirect()->intended('/');
    // }

    // return redirect()->back()->withInput()->withErrors(['username' => 'Invalid Credentials']);
    $credentials = $request->validate([
      'username' => ['required'],
      'password' => ['required'],
    ]);

    if (Auth::attempt($credentials)) {
        $request->session()->regenerate();

        return redirect()->intended('/');
    }
    return back()->withErrors([
      'username' => 'The provided credentials do not match our records.',
    ])->onlyInput('username');
  }

  public function logout()
  {
    Auth::logout();

    return redirect()->route('loginpage');
    // Auth::logout();

    // $request->session()->invalidate();

    // $request->session()->regenerateToken();

    // return redirect()->route('loginpage');
  }
}
