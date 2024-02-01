<?php

namespace App\Http\Controllers\employee;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Employee;
use App\Models\Department;
use App\Models\Golongan;
use App\Models\Leave_employee;
use Illuminate\Support\Str;
use App\Models\User;
use App\Models\Atasan;
use Auth;
use App\Models\ActivityLog;

class EmployeeController extends Controller
{
  public function index()
  {
    $title = 'Data Profil Hakim dan Pegawai';
    $data = Employee::orderBy('department_id','asc')->get();
    UserLogAccess('lihat halaman'.' '.$title);

    return view('content.employee.index', [
      'data' => $data,
    ]);
  }

  public function profile()
  {
    UserLogAccess();

    $activities = ActivityLog::where('user_id', Auth::user()->id)->orderBy('created_at', 'desc')->get();
    // dd($activities->user->employee->nama);

    return view('content.profile.profile', [
      'activities' => $activities,
    ]);
  }

  public function detail($nip)
  {
    $title = 'Profil Hakim dan Pegawai';

    $user = Auth::user();
    $golongan = Golongan::get();
    $position = Department::get();
    $emp = Employee::where('nip', $nip)->first();
    // Inisialisasi variabel $isAdmin dengan nilai default false
    $isAdmin = false;
    UserLogAccess('lihat halaman detail '. $title.' '.'(NIP: '.$nip.')');

    // Memeriksa apakah pengguna adalah admin
    if ($user && ($user->role === 'admin' || $user->role === 'kepegawaian') ) {
        $isAdmin = true;
    }



    if($user->role === 'admin' || $user->employee->nip === $nip || $user->role === 'kepegawaian')  {
      $pegawaidetail = Employee::where('nip', $nip)->first();
      $leave_employee = Leave_employee::where('employee_id', $pegawaidetail->id)->get();

      return view('content.employee.employee',[
        'pegawaidetail' => $pegawaidetail,
        'leave_employee' => $leave_employee,
        'isAdmin' => $isAdmin,
        'golongan' => $golongan,
        'position' => $position,
        'emp' => $emp,
      ]);
    } else {
      abort(403, 'Unauthorized');
    }
    // dd($pegawaidetail);


  }

  public function create()
  {

    $title = 'Tambah Hakim dan Pegawai';
    $golongan = Golongan::get();
    $jabatan = Department::get();
    $atasan = Atasan::get();
    UserLogAccess('lihat halaman '.$title);

    return view('content.employee.create', [
      'golongan' => $golongan,
      'jabatan' => $jabatan,
      'atasan' => $atasan
    ]);
  }

  public function updateCell(Request $request)
  {
    $title = 'Update Tabel Cuti';
      //   $request->validate([
      //     'tahun' => 'required|numeric',
      //     'newValue' => 'required|numeric',
      //     'employee_id' => 'required|numeric',
      // ]);

      $tahun = $request->tahun;
      $newValue = $request->newValue;
      $employeeId = $request->employee_id;

      // Find the LeaveEmployee model based on employee_id and tahun
      $leave = Leave_employee::where('employee_id', $employeeId)->where('tahun', $tahun)->first();

      if ($leave) {
          // Update the jumlah_cuti field
          $leave->update(['jumlah_cuti' => $newValue]);
      }

      UserLogAccess('melakukan '.$title.' '.'(Nip: '.$leave->employee->nip.')');

      return response()->json(['success' => true]);
  }

  public function addPegawai(Request $request)
  {
    // Validasi data dari form
    $title = 'Profil Hakim dan Pegawai';
    $request->validate([
      'nama' => 'required',
      'nip' => 'required',
      'tmt' => 'required',
      // 'phone' => 'required',
      // 'email' => 'required|email',
      'jabatan' => 'required',
      'golongan' => 'required',
    ]);

    // Check for duplicate NIP
    if (Employee::where('nip', $request->nip)->exists()) {
      return back()->with('error', 'NIP sudah ada!');
    }

    // Check if 'jabatan' is 'Ketua' or '1'
    if ($request->jabatan === '1') {
        return back()->with('error', 'Jabatan Ketua sudah dipilih!');
    }

    $password = Str::substr($request->nip, 0, 6);

    $user = new User;
    $user->username = $request->nip;
    $user->password = bcrypt($password);
    // dd($request->jabatan);
    $user->role = $request->role;
    $user->save();
    // dd($user);

    // Simpan data ke database A (tabel pegawai)
    $pegawai = new Employee;
    $pegawai->nama = $request->nama;
    $pegawai->nip = $request->nip;
    $pegawai->tmt = $request->tmt;
    $pegawai->phone = '000000';
    $pegawai->email = 'isikan@mahkamahagung.go.id';
    $pegawai->alamat = 'Sesuaikan dengan data SIKEP';
    $pegawai->department_id = $request->jabatan;
    $pegawai->golongan_id = $request->golongan;
    $pegawai->user_id = $user->id;
    $pegawai->save();

    UserLogAccess('menambahkan '.$title.' '.'(Nip: '.$request->nip.')');
    // dd($pegawai);

    // Redirect atau berikan respons sesuai kebutuhan
    return redirect()->route('profil-hakim-pegawai-pns')->with('success', 'Pegawai berhasil ditambahkan.')->withInput();
  }

  public function editpegawai(Request $request, $nip)
  {
    $title = 'Update Profil Hakim dan Pegawai';
    $request->validate([
      'nama' => 'required',
      'nip' => 'required',
      'phone' => 'required',
      // 'email' => 'required|email',
      'department_id' => 'required',
    ]);

    $golongan = Golongan::get();

    $pegawai = Employee::where('nip', $nip)->first();
    $pegawai->nama = $request->nama;
    $pegawai->nip = $nip;
    $pegawai->phone = $request->phone;
    $pegawai->email = $request->email;
    $pegawai->department_id = $request->department_id;
    $pegawai->golongan_id = $request->golongan_id;
    $pegawai->tmt = $request->tmt;
    $pegawai->alamat = $request->alamat;
    $pegawai->tanggal_lahir = $request->tanggal_lahir;
    $pegawai->update();

    UserLogAccess('melakukan '.$title.' '.'(Nip: '.$nip.')');

    return redirect()->route('profil-pegawai-detail', [
      'nip' => $nip,
      'golongan' => $golongan,
      ])->with('success', 'Profil pegawai berhasil diperbarui');

  }
}
