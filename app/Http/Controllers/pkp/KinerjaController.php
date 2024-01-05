<?php

namespace App\Http\Controllers\pkp;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Leave;
use App\Models\Employee;
use App\Models\Department;
use App\Models\Sasaran_kegiatan;
use App\Models\Indikator_pkp;
use App\Models\Indikator_pck;
use App\Models\Atasan;
use App\Models\Penilaian_kinerja;
use App\Models\Perjanjian_kinerja;
use DB;
use Auth;
class KinerjaController extends Controller
{
  public function index()
  {
    $employeesAtasan = Employee::join('departments', 'employees.department_id', '=', 'departments.id')
    ->where('departments.is_atasan', 1)
    ->get(['employees.*', 'departments.nama_jabatan as nama_jabatan']); // Tambahkan kolom apa pun yang Anda perlukan dari department
    // dd($employeesAtasan);
    $datas = Penilaian_kinerja::where('employee_id', Auth::user()->employee->id)->get();

    return view('content.pkp.index', [
      'atasan' => $employeesAtasan,
      'datas' => $datas
    ]);
  }

  public function buatPKP(Request $request)
  {

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


  public function indexIndikatorPCK()
  {
    $hasil = [
      'Artikel', 'Data Amar', 'Data Elektronik', 'Perkara Putusan', 'BAS', 'Data perkara'
    ];

    $data = Indikator_pck::get();

    return view('content.pkp.indikator_pck',[
      'hasil' => $hasil,
      'data' => $data,
    ]);
  }

  public function tambahIndikatorPCK(Request $request)
  {
    $user = Auth::user()->employee->id;

    $datapck = new Indikator_pck;
    $datapck->butir_kegiatan = $request->butir_kegiatan;
    $datapck->employee_id = $user;
    $datapck->hasil = $request->hasil;
    $datapck->status = 0;
    $datapck->save();

    return redirect()->back()->with('success', 'Sasaran kegiatan dan indikator PKP berhasil ditambahkan.');
  }

  public function tambahPKP(Request $request)
  {
    $penilaian_kinerja = new Penilaian_kinerja;
    $penilaian_kinerja->periode_mulai = $request->periode_mulai;
    $penilaian_kinerja->periode_selesai  = $request->periode_selesai ;
    $penilaian_kinerja->satuan = 0;
    $penilaian_kinerja->target_kuantitas = 0;
    $penilaian_kinerja->indikator_pkp_id = 0;
    $penilaian_kinerja->pejabat_penilai = $request->pejabat_penilai;
    $penilaian_kinerja->atasan_pejabat_penilai = $request->atasan_pejabat_penilai;
    $penilaian_kinerja->employee_id = Auth::user()->employee->id;
    $penilaian_kinerja->save();

    $pkpId = $penilaian_kinerja->id;

    return redirect()->route('penilaian-kinerja', $pkpId);
  }

  public function penilaian_kinerja($id, Request $request)
  {
    $pkp = Penilaian_kinerja::where('id', $id)->first();
    // dd($pkp->id);
    $sasaran_kegiatan = Sasaran_kegiatan::get();
    $indikator = Indikator_pkp::get();

    $atasan = Penilaian_kinerja::with('pejabatPenilai')->find($pkp->id);

    return view('content.pkp.penilaian_kinerja', [
      'sasaran_kegiatan' => $sasaran_kegiatan,
      'indikator' => $indikator,
      'pkp' => $pkp,
      'atasan' => $atasan,
    ]);
  }

  public function tambahPerjanjian(Request $request)
  {
    // Validasi request
    $validatedData = $request->validate([
      'sasaran_kegiatan' => 'required',
      'indikator' => 'required',
      'satuan' => 'required',
      'target_kuantitas' => 'required',
      'penilaian_kinerja_id' => 'required',
    ]);

    // Ubah input menjadi array jika hanya ada satu baris input
    $data = [];
    foreach (['sasaran_kegiatan', 'indikator', 'satuan', 'target_kuantitas','penilaian_kinerja_id'] as $field) {
      $data[$field] = is_array($validatedData[$field]) ? $validatedData[$field] : [$validatedData[$field]];
    }

    // Gunakan transaksi untuk menyimpan semua data atau tidak sama sekali
    DB::transaction(function () use ($data, $request) {
      foreach ($data['sasaran_kegiatan'] as $key => $value) {
          Perjanjian_kinerja::create([
              'sasaran_kegiatan' => $value,
              'indikator' => $data['indikator'][$key],
              'satuan' => $data['satuan'][$key],
              'target_kuantitas' => $data['target_kuantitas'][$key],
              'penilaian_kinerja_id' => $data['penilaian_kinerja_id'][$key],
          ]);
      }
    });

    return redirect()->back()->with('success', 'Data berhasil disimpan.');
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
