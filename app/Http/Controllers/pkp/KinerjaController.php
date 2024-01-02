<?php

namespace App\Http\Controllers\pkp;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Leave;
use App\Models\Employee;
use App\Models\Sasaran_kegiatan;
use App\Models\Indikator_pkp;
use DB;
use Auth;
class KinerjaController extends Controller
{
  public function index()
  {

    return view('content.pkp.index');
  }

  public function indexIndikatorPKP()
  {

    $sasaran_kegiatan = Sasaran_kegiatan::get();
    $data = Indikator_pkp::get();
    // dd($data);

    return view('content.pkp.indikator_pkp', [
      'sasaran_kegiatan' => $sasaran_kegiatan,
      'data' => $data,
    ]);
  }

  public function tambahIndikatorPKP(Request $request)
  {
        $request->validate([
            // validasi untuk field lain...
            'sasaran_kegiatan_text' => 'required', // Validasi ini hanya jika sasaran_kegiatan adalah 'lainnya'
            'indikator' => 'required', // Asumsikan Anda memiliki field 'indikator' untuk input teks indikator
        ]);

        DB::beginTransaction(); // Mulai transaksi database

        try {
            $sasaranKegiatanId = null;

            if ($request->sasaran_kegiatan_id === 'lainnya') {
                // Membuat sasaran kegiatan baru
                $sasaranKegiatan = Sasaran_kegiatan::create([
                    'sasaran_kegiatan_text' => $request->sasaran_kegiatan_text,
                ]);

                $sasaranKegiatanId = $sasaranKegiatan->id; // Ambil ID yang baru dibuat
            }

            // Membuat indikator PKP dengan foreign key sasaran_kegiatan_id
            $indikatorPKP = Indikator_pkp::create([
                'sasaran_kegiatan_id' => $sasaranKegiatanId,
                'employee_id' => Auth::user()->employee->id,
                'indikator' => $request->indikator,
                'status' => 0,
                // Isi kolom lain yang diperlukan
            ]);

            DB::commit(); // Commit transaksi jika tidak ada masalah

            return redirect()->back()->with('success', 'Sasaran kegiatan dan indikator PKP berhasil ditambahkan.');
        } catch (\Exception $e) {
            DB::rollback(); // Rollback transaksi jika terjadi kesalahan

            // Log error atau tangani sesuai kebutuhan
            return redirect()->back()->with('error', 'Terjadi kesalahan saat menyimpan data: ' . $e->getMessage());
        }
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
