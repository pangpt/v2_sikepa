<?php

namespace App\Http\Controllers\hakim_pegawai;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HakimPegawaiController extends Controller
{
  public function index()
  {
    return view('content.hakim_pegawai.index');
  }

  public function tambah()
  {
    return view('content.hakim_pegawai.tambah');
  }
}
