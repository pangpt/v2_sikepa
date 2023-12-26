<?php

namespace App\Http\Controllers\izin_cuti;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Leave;
use App\Models\Employee;
use App\Models\Leave_employee;
use App\Models\Leave_approval;
use App\Models\Department;
use App\Models\Atasan;
use App\Models\User;
use App\Models\Permohonan_cuti;
use App\Models\Satker_information;
use Carbon\Carbon;
use Auth;
use PDF;
use SimpleSoftwareIO\QrCode\Facades\QrCode;


class CutiController extends Controller
{
  public function index()
  {
    $user = Auth::user()->role;
    $jmlApprove = Leave::where('status_permohonan', 1)->count();
    $jmlVerif = Leave::where('status_permohonan', 2)->count();

    // dd($user->role);
    @$atasan = auth()->user()->employee->department->id;
    @$cek = Atasan::where('department_id', $atasan)->first();

    $leave_cek = Leave_employee::where('employee_id', Auth()->user()->id)->first();
    // dd($leave_cek);

    // if($user == 'pegawai') {
    //   $data = Leave::where('employee_id', Auth::user()->employee->id)->orderBy('created_at', 'desc')->get();
    // } elseif ($user == 'kepegawaian' || $user == 'kasubag' || $user == 'admin') {
    //   $data = Leave::orderBy('created_at', 'desc')->get();
    // } elseif ($user == 'sekretaris') {
    //   $data = Leave::where('atasan_id', $cek->id)->orderBy('created_at', 'desc')->get();
    // } elseif ($user == 'panitera') {
    //   $data = Leave::where('atasan_id', 2)->orderBy('created_at', 'desc')->get();
    // } elseif ($user == 'admin' || $user == 'ketua') {
    //   $data = Leave::orderBy('created_at', 'desc')->get();
    // }
    if($user == 'pegawai') {
      $data = Leave::where('employee_id', Auth::user()->employee->id)->orderBy('created_at', 'desc')->get();
    } elseif ($user == 'kepegawaian' || $user == 'admin' || $user == 'ketua') {
      $data = Leave::orderBy('created_at', 'desc')->get();
    } else {
      @$data = Leave::where('atasan_id', $cek->id)->orderBy('created_at', 'desc')->get();
    }


    return view('content.izin-cuti.index',[
      'data' => $data,
      'jmlApprove' => $jmlApprove,
      'jmlVerif' => $jmlVerif,
      'leaveTotal' => $leave_cek,
    ]);
  }

  public function indexApproval()
  {
    $user = Auth::user()->role;
    $jml = Leave::where('status_permohonan', 1)->count();

    $atasan = auth()->user()->employee->department->id;
    $cek = Atasan::where('department_id', $atasan)->first();


    if($user == 'pegawai') {
      $data = Leave::where('employee_id', Auth::user()->id)->where('status_permohonan', 1)->orderBy('created_at', 'desc')->get();
    } elseif ($user == 'kepegawaian' || $user === 'ketua' || $user == 'admin') {
      $data = Leave::orderBy('created_at', 'desc')->where('status_permohonan', 1)->get();
    } else {
      $data = Leave::where('atasan_id', $cek->id)->where('status_permohonan', 1)->orderBy('created_at', 'desc')->get();
    }


    return view('content.izin-cuti.approval',[
      'data' => $data,
      'jml' => $jml
    ]);
  }

  public function indexVerifikasi()
  {
    $user = Auth::user()->role;
    $jml = Leave::where('status_permohonan', 2)->count();

    if($user === 'pegawai' || $user === 'fungsional') {
      $data = Leave::where('employee_id', Auth::user()->id)->where('status_permohonan', 2)->orderBy('created_at', 'desc')->get();
    } elseif ($user === 'kepegawaian' || $user === 'kasubag' || $user === 'admin') {
      $data = Leave::orderBy('created_at', 'desc')->where('status_permohonan', 2)->get();
    } elseif ($user === 'sekretaris') {
      $data = Leave::where('atasan_id', 3)->where('status_permohonan', 2)->orderBy('created_at', 'desc')->get();
    } elseif ($user === 'panitera') {
      $data = Leave::where('atasan_id', 2)->where('status_permohonan', 2)->orderBy('created_at', 'desc')->get();
    } elseif ($user === 'admin' || $user == 'ketua') {
      $data = Leave::where('status_permohonan', 2)->orderBy('created_at', 'desc')->get();
    }


    return view('content.izin-cuti.verifikasi',[
      'data' => $data,
      'jml' => $jml
    ]);
  }

  public function tambah()
  {
    $pegawaidetail = Employee::where('user_id', auth()->user()->id)->first();
    // dd($pegawaidetail->atasan->nama);
    $leave_employee = Leave_employee::where('employee_id', $pegawaidetail->id)->get();
    $pimpinan = Atasan::where('department_id', '1')->first();
    $parent = $pegawaidetail->department->parent_id;
    $atasan = Employee::where('department_id', $parent)->first();

    return view('content.izin-cuti.pengajuan', [
      'pegawaidetail' => $pegawaidetail,
      'leave_employee' => $leave_employee,
      'pimpinan' => $pimpinan,
      'atasan' => $atasan,
    ]);
  }

  public function updateLeaveYearly()
  {
    //dapatkan tahun saat ini
    $currentYear = date('Y');

    //loop melalui semua pegawai
    $employees = Employee::all();

    foreach($employees as $employee) {
      //periksa data cuti tahunan
      $leave_employee = Leave_employee::where('employee_id', $employee->id)->where('tahun', $currentYear)->first();

      // Hapus data sisa cuti tahunan untuk tiga tahun sebelumnya
      $threeYearsAgo = $currentYear - 3;
      Leave_employee::where('tahun', '<', $threeYearsAgo)->delete();

      if(!$leave_employee) {
        // Jika belum ada, buat data baru dengan jumlah cuti 0 untuk tahun saat ini
        $leaveYearly = new Leave_employee();
        $leaveYearly->employee_id = $employee->id;
        $leaveYearly->tahun = $currentYear;
        $leaveYearly->jumlah_cuti = 12;
        $leaveYearly->save();

        // Hapus data sisa cuti tahunan tiga tahun sebelumnya
        Leave_employee::where('employee_id', $employee->id)
            ->where('tahun', '<', $threeYearsAgo)
            ->delete();
      }

      // Periksa tahun sebelumnya
      $previousYear = $currentYear - 1;
      $previousLeaveYearly = Leave_employee::where('employee_id', $employee->id)
          ->where('tahun', $previousYear)
          ->first();

      if (!$previousLeaveYearly) {
          // Jika belum ada, buat data baru dengan jumlah cuti 0 untuk tahun sebelumnya
          $previousLeaveYearly = new Leave_employee();
          $previousLeaveYearly->employee_id = $employee->id;
          $previousLeaveYearly->tahun = $previousYear;
          $previousLeaveYearly->jumlah_cuti = 0;
          $previousLeaveYearly->save();
      }

      // Periksa dua tahun yang lalu
      $twoYearsAgo = $currentYear - 2;
      $twoYearsAgoLeaveYearly = Leave_employee::where('employee_id', $employee->id)
          ->where('tahun', $twoYearsAgo)
          ->first();

      if (!$twoYearsAgoLeaveYearly) {
          // Jika belum ada, buat data baru dengan jumlah cuti 0 untuk dua tahun yang lalu
          $twoYearsAgoLeaveYearly = new Leave_employee();
          $twoYearsAgoLeaveYearly->employee_id = $employee->id;
          $twoYearsAgoLeaveYearly->tahun = $twoYearsAgo;
          $twoYearsAgoLeaveYearly->jumlah_cuti = 0;
          $twoYearsAgoLeaveYearly->save();
      }
    }

    return redirect()->back()->with('success', 'Pengaturan cuti berhasil.');
  }

  public function addCuti(Request $request)
  {
    // Validasi form
    $request->validate([
      'periode_awal' => 'required|date',
      'periode_akhir' => 'required|date|after_or_equal:periode_awal',
      'lampiran' => 'nullable|file|mimes:pdf,jpg,jpeg|max:2048', // Ubah sesuai kebutuhan
    ]);
    // $employee = Employee::where('id', $user->employee_id->id)->first();

    $user = Auth::user();
    $pegawaidetail = Employee::where('user_id', auth()->user()->id)->first();
    $atasan = Atasan::where('department_id', $pegawaidetail->department->parent_id)->first();

    $dataCuti = new Leave;
    $dataCuti->employee_id = $user->employee->id;
    $dataCuti->atasan_id = $atasan->id;
    $dataCuti->jenis_cuti = $request->jenis_cuti;
    $dataCuti->alasan = $request->alasan;
    $dataCuti->periode_awal = $request->periode_awal;
    $dataCuti->periode_akhir = $request->periode_akhir;
    $dataCuti->jumlah_hari = $request->jumlah_hari;
    $dataCuti->alamat_cuti = $request->alamat_cuti;
    $dataCuti->phone_cuti = $request->phone_cuti;
    $dataCuti->pimpinan = '1';
    if(!empty($request->lampiran)){
      $dataCuti->lampiran = $request->file('lampiran')->store('public/filelampiran');
    }
    $dataCuti->status_permohonan = '0';
    $dataCuti->save();

    return redirect()->route('layanan-izin-cuti-index')->with('success', 'Pengajuan cuti berhasil diajukan.');

  }

  public function penangguhan()
  {
    return view('content.izin-cuti.penangguhan');
  }

  public function detail($id)
  {
    $izinCuti = Leave::where('id', $id)->first();
    $jabatan = $izinCuti->employee->department_id;
    $jab = Department::where('id', $jabatan)->first();
    $approveLeave = Leave_approval::where('leave_id', $id)->first();
    $user = $id;
    $verifikator = User::where('role', 'kepegawaian')->first();
    $ketua = Department::where('slug', 'ketua')->first();
    $namaKetua = Employee::where('department_id', $ketua->id)->first();
    $atasan = auth()->user()->employee->department->id;
    $cek = Atasan::where('department_id', $atasan)->first();
    // dd($jabatan);

    return view('content.izin-cuti.detail', [
      'jab' => $jab,
      'izinCuti' => $izinCuti,
      'approveLeave' => $approveLeave,
      'user' => $user,
      'verifikator' => $verifikator,
      'ketua' => $ketua,
      'namaKetua' => $namaKetua,
      'cek' => $cek,
    ]);
  }

  public function approve(Request $request)
  {
    $leave_id = $request->input('leave_id');
    $catatan = $request->input('catatan');
    $user_id = $request->input('user_id');
    $department_id = $request->input('department_id');
    $employee_id = $request->input('employee_id');
    $userRole = $request->input('role');
    $tanggal = Carbon::now();

    $pegawaidetail = Leave::where('employee_id', $employee_id)->first();
    $parent = $pegawaidetail->employee->department->parent_id;
    $atasan = Employee::where('department_id', $parent)->first();

    $izinCuti = Leave::where('id', $leave_id)->first();

    $atasanLangsung = auth()->user()->employee->department->parent_id;
    $cek = Atasan::where('department_id', $atasanLangsung)->first();

    $approveLeave = new Leave_approval();
    $approveLeave->leave_id = $leave_id;
    $approveLeave->user_id = $user_id;
    $approveLeave->atasan_id = $cek->id ;

    if ($userRole == 'ketua' || $userRole == 'admin') {
      $approveLeave->status_approval = '1';
    } elseif ($userRole ==  $atasan->user->role) {
        $approveLeave->status_approval = '2';
    } elseif ($userRole == 'kepegawaian') {
        $approveLeave->status_approval = '3';
        $setCuti = new Permohonan_cuti;
        $setCuti->leave_id = $leave_id;
        $setCuti->sign_permohonan = $leave_id.'.'.$atasan->nip;
        $setCuti->save();

        $currentYear = date('Y');
        $leave_employee = Leave_employee::where('employee_id', $employee_id)->where('tahun', $currentYear)->first();

        if(!$leave_employee) {
          // Jika belum ada, buat data baru dengan jumlah cuti 0 untuk tahun saat ini
          $leaveYearly = new Leave_employee();
          $leaveYearly->employee_id = $employee_id;
          $leaveYearly->tahun = $currentYear;
          $leaveYearly->jumlah_cuti = 12 - $izinCuti->jumlah_hari;
          $leaveYearly->save();
        } else {
          $leaveYearly = Leave_employee::find($leave_employee->id);
          $leaveYearly->jumlah_cuti = $leave_employee->jumlah_cuti - $pegawaidetail->jumlah_hari;
          $leaveYearly->update();
        }
    }
    $approveLeave->tanggal_approval = $tanggal;
    $approveLeave->save();

     // Update status pengajuan cuti
    $leaveRequest = Leave::find($leave_id);
    if($userRole == 'ketua' || $userRole == 'admin' ){
      $leaveRequest->status_permohonan = '1';
    } elseif ($userRole == $izinCuti->atasan->department->slug) {
      $leaveRequest->status_permohonan = '2';
    } elseif ($userRole == 'kepegawaian') {
      $leaveRequest->status_permohonan = '3';
    }
    $leaveRequest->update();

    return response()->json(['message' => $parent]);

  }

  public function generateCuti($id)
  {
    $infoSatker = Satker_information::first();
    $izinCuti = Leave::where('id', $id)->first();
    $atasanLangsung = Employee::where('department_id', $izinCuti->atasan->department_id)->first();
    $pegawai = Employee::where('id', $izinCuti->employee_id)->first();

    $currentYear = date('Y');
    $pastOneYear = $currentYear - 1;
    $pastTwoYear = $currentYear - 2;

    $ketua = Employee::where('department_id', '1')->first();
    $sisaLast = Leave_employee::where('employee_id', $izinCuti->employee_id)->where('tahun', $pastTwoYear)->first();
    $sisaPast = Leave_employee::where('employee_id', $izinCuti->employee_id)->where('tahun', $pastOneYear)->first();
    $sisaNow = Leave_employee::where('employee_id', $izinCuti->employee_id)->where('tahun', $currentYear)->first();
    $signatureCode = $izinCuti->atasan->nama;
    $baseUrl = url('/');
    $data = [
      'atasanLangsung' => $atasanLangsung,
      'ketua' => $ketua,
      'pegawai' => $pegawai,
      'cuti' => $izinCuti, // Data cuti yang Anda ingin tampilkan dalam tabel
      'sisaLast' => $sisaLast, // Data cuti yang Anda ingin tampilkan dalam tabel
      'sisaPast' => $sisaPast, // Data cuti yang Anda ingin tampilkan dalam tabel
      'sisaNow' => $sisaNow, // Data cuti yang Anda ingin tampilkan dalam tabel
      'signatureQR' => QrCode::size(100)->generate($baseUrl.'/view/izin-cuti/'.$izinCuti->id.'.'.$ketua->nip), // Generate QR Code dengan pesan
      'infoSatker' => $infoSatker,
    ];

    $pdf = PDF::loadView('pdf.cetak', $data); // 'pdf.cetak' adalah nama view PDF

    return $pdf->stream('izincuti.pdf');
  }

  public function viewCuti($sign_permohonan)
  {
    $getNip = explode('.', $sign_permohonan);
    // dd($getNip[0]);
    $izinCuti = Leave::where('id', $getNip[0])->first();
    // dd($izinCuti);
    $ketua = Employee::where('department_id', '1' )->first();

    return view('content.izin-cuti.ttd', [
      'izinCuti' => $izinCuti,
      'ketua' => $ketua,
    ]);
  }
}
