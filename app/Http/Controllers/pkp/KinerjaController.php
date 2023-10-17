<?php

namespace App\Http\Controllers\pkp;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Leave;
use App\Models\Employee;
use App\Models\Satker_information;

class KinerjaController extends Controller
{
  public function index()
  {

    return view('content.pkp.index');
  }

  public function indexIndikator()
  {

    return view('content.pkp.indikator');
  }

  public function tambah()
  {
    return view('content.izin-cuti.pengajuan');
  }

  public function penangguhan()
  {
    return view('content.izin-cuti.penangguhan');
  }

  public function detail($id)
  {
    $pemohon = Employee::where('id', $id)->first();
    $izinCuti = Leave::where('id', $id)->first();

    return view('content.izin-cuti.detail', [
      'pemohon' => $pemohon,
      'izinCuti' => $izinCuti,
    ]);
  }
}
