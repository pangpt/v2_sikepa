<?php

namespace App\Http\Controllers\izin_cuti;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CutiController extends Controller
{
  public function index()
  {
    return view('content.izin-cuti.index');
  }

  public function tambah()
  {
    return view('content.izin-cuti.pengajuan');
  }

  public function penangguhan()
  {
    return view('content.izin-cuti.penangguhan');
  }

  public function approval()
  {
    return view('content.izin-cuti.approval');
  }

  public function verifikasi()
  {
    return view('content.izin-cuti.verifikasi');
  }
}
