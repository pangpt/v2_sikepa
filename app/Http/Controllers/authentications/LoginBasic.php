<?php

namespace App\Http\Controllers\authentications;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\ActivityLog;

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

    // Cek credentials dan is_active status
    if (Auth::attempt($credentials)) {
      $user = Auth::user();
        if ($user->is_active != 1) {
            Auth::logout();
            return redirect()->back()->withInput($request->except('password'))->with('error', 'Maaf, akun belum aktif.');
        }

        ActivityLog::create([
          'user_id' => $user->id,
          'description' => 'User Logged In',
        ]);

        $request->session()->regenerate();
        return redirect()->intended('/');

    }
    // Redirect dengan pesan salah password.
    return back()->withInput($request->except('password'))
                 ->with('login_error', 'Maaf, NIP atau password anda salah, silahkan coba lagi.');

    // return back()->withErrors([
    //   'login_error' => 'Maaf, NIP atau password Anda salah',
    // ])->onlyInput('login_error');
  }

  protected function sendLoginResponse(Request $request)
  {
      $request->session()->regenerate();

      // Log the activity here
      ActivityLog::create([
          'user_id' => Auth::id(),
          'description' => 'User Logged In',
      ]);

      // The rest of the method...
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
