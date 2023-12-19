<?php

namespace App\Http\Controllers\informasi;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Information;

class InformasiController extends Controller
{
  public function index()
  {
    $info = Information::get();

    return view('content.informasi.index', [
      'info' => $info,
    ]);
  }

  public function informasiCreate()
  {
    return view('content.informasi.create');
  }

  public function store(Request $request)
  {
    $datas = new Information();
    $datas->judul = $request->judul;
    $datas->isi_konten = $request->isi_konten;
    $datas->tanggal = date('Y-m-d', strtotime('now'));
    $datas->file_path = "";
    $datas->save();

    return redirect()->route('informasi-umum')->withErrors([
      'success' => 'Berhasil menambahkan informasi'
    ]);
  }

}
