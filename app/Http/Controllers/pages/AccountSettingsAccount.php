<?php

namespace App\Http\Controllers\pages;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Employee;

class AccountSettingsAccount extends Controller
{
  public function index($nip)
  {
    $pegawaidetail = Employee::where('nip', $nip)->first();
    // dd($pegawaidetail);

    return view('content.pages.pages-account-settings-account',[
      'pegawaidetail' => $pegawaidetail,
    ]);
  }
}
