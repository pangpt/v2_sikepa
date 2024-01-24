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
use App\Models\Capaian_kinerja;
use App\Models\Penilaian_kinerja;
use App\Models\Perjanjian_kinerja;
use App\Models\Periode_pck;
use App\Models\Penilaian_capaian;
use Illuminate\Support\Facades\Log;
use DB;
use Auth;
use PDF;
use SimpleSoftwareIO\QrCode\Facades\QrCode;


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
      // Validasi input
      $validationRules = [
          'indikator' => 'required',
          // validasi untuk field lain...
      ];

      if ($request->sasaran_kegiatan_id === 'lainnya') {
          $validationRules['sasaran_kegiatan_text'] = 'required';
      }

      $request->validate($validationRules);

      DB::beginTransaction(); // Mulai transaksi database

      try {
          $sasaranKegiatanId = $request->sasaran_kegiatan_id; // Gunakan ID ini jika bukan 'lainnya'

          if ($sasaranKegiatanId === 'lainnya') {
              // Membuat sasaran kegiatan baru jika 'lainnya'
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

    return redirect()->route('layanan-pkp')->with('success', 'Data berhasil disimpan.');
  }

  public function sasaran_kegiatan($id)
  {
    $perjanjian = Perjanjian_kinerja::where('penilaian_kinerja_id', $id)->get();
    $penilaian = Penilaian_kinerja::where('id', $id)->get();
    // dd($penilaian);
    $data = Penilaian_kinerja::where('id', $id)->first();
    $atasan = Penilaian_kinerja::with('pejabatPenilai')->find($data->id);
    $capaian = Penilaian_capaian::where('penilaian_kinerja_id', $id)->get();

    return view('content.pkp.skp',[
      'perjanjian' => $perjanjian,
      'penilaian' => $penilaian,
      'data' => $data,
      'atasan' => $atasan,
      'capaian' => $capaian,
    ]);
  }

  public function capaian_kinerja($id)
  {
    $periodeId = session('periodeId');
    // dd($periodeId);
    $perjanjian = Perjanjian_kinerja::with('capaian_kinerja')->where('penilaian_kinerja_id', $id)->get();
    foreach($perjanjian as $key){
      $data = Penilaian_kinerja::where('id', $key->penilaian_kinerja_id)->first();
    }
    $atasan = Penilaian_kinerja::with('pejabatPenilai')->find($data->id);
    $indikator_pck = Indikator_pck::get();

    return view('content.pkp.pck',[
      'perjanjian' => $perjanjian,
      'data' => $data,
      'atasan' => $atasan,
      'indikator_pck' => $indikator_pck,
      'periodeId' => $periodeId,

      // 'capaian' => $capaian,
    ]);
  }

  public function simpan_capaian(Request $request)
  {
        // Validasi request
       $validatedData = $request->input('data');
       $rataRataTotal = $request->input('rataRataTotal'); // Pastikan ini di-pass dari AJAX call
       //  dd($validatedData);

       foreach ($validatedData as $tableData) {
        $tableId = $tableData['id']; // Ini adalah ID dari tabel PCK
        $capaians = $tableData['capaian']; // Ini adalah array dari capaian
        $status = $tableData['status'];


        foreach ($capaians as $capaian) {
            if (!empty($capaian)) { // Cek jika array capaian tidak kosong
                // Proses data capaian disini
                // $kinerja = Capaian_kinerja::findOrNew($capaian['id']);
                $kegiatan = $capaian['kegiatan'];
                $targetKuantitas = $capaian['target_kuantitas'];
                $targetKualitas = $capaian['target_kualitas'];
                $realisasiKuantitas = $capaian['realisasi_kuantitas'];
                $realisasiKualitas = $capaian['realisasi_kualitas'];
                $nilaiCapaian = $capaian['nilai_capaian'];
                $periode = $capaian['periode_pck_id'];
                $penilaianId = $capaian['penilaian_kinerja_id'];

                // Misal Anda ingin menyimpan ke database
                $model = new Capaian_kinerja(); // Ganti dengan nama model yang sebenarnya
                $model->perjanjian_kinerja_id = $tableId;
                $model->penilaian_kinerja_id = $penilaianId;
                $model->indikator_pkp_id = 0;
                $model->indikator_pck_id = $kegiatan;
                $model->periode_pck_id = $periode;
                // $model->employee_id = Auth()->user()->employee->id;
                $model->realisasi_mutu = $realisasiKualitas;
                $model->realisasi_output = $realisasiKuantitas;
                $model->target_output = $targetKuantitas;
                $model->target_mutu = $targetKualitas;
                $model->bukti_dukung = 'asdsadsd';
                $model->status_pck = $status;
                $model->nilai_capaian = $nilaiCapaian;
                // Set sisa field model sesuai dengan array capaian
                $model->save();
            }
        }
    }

    $penilaianId = $model->penilaian_kinerja_id;
    $period = $model->periode_pck_id;

    $laporan_pck = new Penilaian_capaian;
    $laporan_pck->penilaian_kinerja_id = $penilaianId;
    $laporan_pck->periode_pck_id = $period;
    $laporan_pck->total_capaian= $rataRataTotal;
    $laporan_pck->status = $status;
    $laporan_pck->save();

    $redirectUrl = route('sasaran-kegiatan', ['id' => $penilaianId]); // atau $penilaianId[0] jika itu array

      // Berikan response sukses
      return response()->json([
        'success' => 'PCK Bulanan berhasil disimpan',
        'redirectUrl' => $redirectUrl
    ]);
  }

  public function simpan_periode_capaian(Request $request)
  {

        $penilaianIds = $request->penilaian_kinerja_id;
        // dd($penilaianIds);
        $bulan = $request->periode_bulan;
        $tahun = $request->periode_tahun;
        $idTarget = $request->idTarget;

        $periode = new Periode_pck;
        $periode->penilaian_kinerja_id = $penilaianIds;
        $periode->periode_bulan = $bulan;
        $periode->periode_tahun = $tahun;
        $periode->save();

        session()->flash('periodeId', $periode->id);
        // foreach ($penilaianIds as $index => $id) {
        //     Periode_pck::create([
        //         'penilaian_kinerja_id' => $id,
        //         'periode_bulan' => $bulan[$index],
        //         'periode_tahun' => $tahun[$index],
        //     ]);
        // }

        // Redirect ke halaman sebelumnya atau tampilkan pesan sukses
        return redirect('layanan-pkp/capaian-kinerja/'.$idTarget.'?bulan='.$periode->periode_bulan)
                     ->with('success', 'Data berhasil disimpan.');


  }

  public function simpan_detail(Request $request)
 {
    $semuaData = $request->input('data');
    $penilaian = $request->input('penilaianId');
    $rataRataTotal = $request->input('rataRataTotal'); // Pastikan ini di-pass dari AJAX call

    foreach ($semuaData as $dataPerTabel){
      foreach ($dataPerTabel['capaian'] as $dataBaris) {
          $statusPck = $dataBaris['status_pck'];
          unset($dataBaris['status_pck']); // Hapus 'status_pck' dari array sebelum menyimpan


          if(empty($dataBaris['id'])){
                // Log::info('Data untuk entri baru:', $dataBaris);
            unset($dataBaris['id']);
            if (empty($dataBaris['perjanjian_kinerja_id']) || empty($dataBaris['penilaian_kinerja_id'])) {
                  Log::error('perjanjian_kinerja_id atau penilaian_kinerja_id tidak ada atau null untuk entri baru', $dataBaris);
                  // Anda bisa memutuskan untuk melanjutkan atau menghentikan eksekusi di sini.
              } else {
                  Capaian_kinerja::create(array_merge($dataBaris, ['status_pck' => $statusPck]));
                  $laporan_pck = Penilaian_capaian::where('penilaian_kinerja_id', $dataBaris['penilaian_kinerja_id'])->where('periode_pck_id', $dataBaris['periode_pck_id'])->first();
                  $laporan_pck->update(array_merge($dataBaris, ['status' => $statusPck, 'total_capaian' => $rataRataTotal]));
              }
          } else{
            $capaian = Capaian_kinerja::find($dataBaris['id']);
            $laporan_pck = Penilaian_capaian::where('penilaian_kinerja_id', $dataBaris['penilaian_kinerja_id'])->where('periode_pck_id', $dataBaris['periode_pck_id'])->first();
            if($capaian) {
              $capaian->update(array_merge($dataBaris, ['status_pck' => $statusPck]));
              $laporan_pck->update(array_merge($dataBaris, ['status' => $statusPck, 'total_capaian' => $rataRataTotal]));
              // dd($capaian);
            }
          }
      }

      $redirectUrl = route('sasaran-kegiatan', ['id' => $penilaian]); // atau $penilaianId[0] jika itu array

    }

    // Ambil ID baris yang akan dihapus dari request
    $barisUntukDihapus = $request->input('barisDihapus', []);
     // Hapus baris yang ditandai untuk dihapus
    foreach ($barisUntukDihapus as $id) {
        $baris = Capaian_kinerja::find($id);
        if ($baris) {
            $baris->delete();
        }
    }

    // Berikan response sukses
      return response()->json([
        'success' => 'PCK Bulanan berhasil disimpan',
        'redirectUrl' => $redirectUrl
    ]);

  }

  public function detail_capaian_kinerja($id)
  {
    $pck = Penilaian_capaian::where('id', $id)->first();
    // dd($pck->penilaian_kinerja_id);
    $capaian = Capaian_kinerja::where('periode_pck_id', $pck->periode_pck_id)->get();
    // dd($capaian);
    // dd($capaian);
    $perjanjian = Perjanjian_kinerja::whereHas('capaian_kinerja', function ($query) use ($pck) {
    $query->where('periode_pck_id', $pck->periode_pck_id);
})
->with(['capaian_kinerja' => function ($query) use ($pck) {
    $query->where('periode_pck_id', $pck->periode_pck_id);
}])
->get();

    // dd($perjanjian);
    foreach($perjanjian as $key){
      $data = Penilaian_kinerja::where('id', $key->penilaian_kinerja_id)->first();
    }
    $atasan = Penilaian_kinerja::with('pejabatPenilai')->find($data->id);
    $indikator_pck = Indikator_pck::get();

    return view('content.pkp.detail_pck',[
      'data' => $data,
      'atasan' => $atasan,
      'pck' => $pck,
      'perjanjian' => $perjanjian,
      'indikator_pck' => $indikator_pck,
      'capaian' => $capaian,
    ]);
  }

  public function penilaian_capaian_kinerja($id)
  {
    $indikatorKinerjas = Perjanjian_kinerja::with(['capaian_kinerja'])->get();


    $pck = Penilaian_capaian::where('id', $id)->first();
    // dd($pck->penilaian_kinerja_id);
    $capaian = Capaian_kinerja::where('periode_pck_id', $pck->periode_pck_id)->get();
    // dd($capaian);
    // dd($capaian);
    $perjanjian = Perjanjian_kinerja::whereHas('capaian_kinerja', function ($query) use ($pck)
    {
      $query->where('periode_pck_id', $pck->periode_pck_id);
    })->with(['capaian_kinerja' => function ($query) use ($pck) {
      $query->where('periode_pck_id', $pck->periode_pck_id);
    }])->get();

    $penilaian_total = Perjanjian_kinerja::whereHas('capaian_kinerja', function ($query) use ($pck) {
      $query->where('periode_pck_id', $pck->periode_pck_id);
  })
  ->with(['capaian_kinerja' => function ($query) use ($pck) {
      $query->where('periode_pck_id', $pck->periode_pck_id)
            ->selectRaw('perjanjian_kinerja_id, AVG(nilai_capaian) as total_nilai_capaian')
            ->groupBy('perjanjian_kinerja_id');
  }])
  ->get();
  // dd($penilaian_total);

    // dd($perjanjian);
    foreach($perjanjian as $key){
      $data = Penilaian_kinerja::where('id', $key->penilaian_kinerja_id)->first();
    }
    $atasan = Penilaian_kinerja::with('pejabatPenilai')->find($data->id);
    $indikator_pck = Indikator_pck::get();

    return view('content.pkp.ajukan_pck',[
      'data' => $data,
      'atasan' => $atasan,
      'pck' => $pck,
      'perjanjian' => $perjanjian,
      'indikator_pck' => $indikator_pck,
      'capaian' => $capaian,
      'penilaian_total' => $penilaian_total,
    ]);
  }

  public function download_pck($id)
  {
    $pck = Penilaian_capaian::where('id', $id)->first();

    $perjanjian = Perjanjian_kinerja::whereHas('capaian_kinerja', function ($query) use ($pck)
    {
      $query->where('periode_pck_id', $pck->periode_pck_id);
    })->with(['capaian_kinerja' => function ($query) use ($pck) {
      $query->where('periode_pck_id', $pck->periode_pck_id);
    }])->get();

    $penilaian_total = Perjanjian_kinerja::whereHas('capaian_kinerja', function ($query) use ($pck) {
      $query->where('periode_pck_id', $pck->periode_pck_id);
  })
  ->with(['capaian_kinerja' => function ($query) use ($pck) {
      $query->where('periode_pck_id', $pck->periode_pck_id)
            ->selectRaw('perjanjian_kinerja_id, AVG(nilai_capaian) as total_nilai_capaian')
            ->groupBy('perjanjian_kinerja_id');
  }])
  ->get();

  foreach ($perjanjian as $indikator) {
    $totalNilaiCapaian = $indikator->capaian_kinerja->sum('nilai_capaian');
    $jumlahCapaian = $indikator->capaian_kinerja->count();
    // dd($totalNilaiCapaian);
    $indikator->rataRataNilaiCapaian = $totalNilaiCapaian / $jumlahCapaian;
}

  foreach($perjanjian as $key){
    $datadiri = Penilaian_kinerja::where('id', $key->penilaian_kinerja_id)->first();
  }
  $atasan = Penilaian_kinerja::with('pejabatPenilai')->find($datadiri->id);

  $signatureCode = $atasan->pejabatPenilai->nama;
  $baseUrl = url('/');

  $data = [
    'penilaian_total' => $penilaian_total,
    'datadiri' => $datadiri,
    'atasan' => $atasan,
    'perjanjian' => $perjanjian,
    'pck' => $pck,
    'signatureQR' => QRCode::size(100)->generate('youtube.com'),

  ];
            $namaBulan = [
              1 => 'Januari',
              2 => 'Februari',
              3 => 'Maret',
              4 => 'April',
              5 => 'Mei',
              6 => 'Juni',
              7 => 'Juli',
              8 => 'Agustus',
              9 => 'September',
              10 => 'Oktober',
              11 => 'November',
              12 => 'Desember'
            ];

  $namaFile = "Laporan_PKP_{$datadiri->employee->nama}_{$namaBulan[$pck->periode_pck->periode_bulan]}_{$pck->periode_pck->periode_tahun}.pdf"; // Contoh nama file dinamis

    // Ubah spasi dengan underscore atau hilangkan karakter yang tidak diinginkan
  $namaFile = str_replace(' ', '_', $namaFile);

  $pdf = PDF::loadView('content.pkp.download', $data);
  return $pdf->download($namaFile);

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
