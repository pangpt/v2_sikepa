<?php

namespace App\Http\Controllers\akun;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Employee;
use App\Models\Department;
use App\Models\Golongan;
use Illuminate\Support\Str;
use App\Models\User;

class AkunController extends Controller
{
  public function index()
  {
    $data = User::get();

    return view('content.akun.index', [
      'data' => $data,
    ]);
  }

  public function detail($nip)
  {
    $pegawaidetail = Employee::where('nip', $nip)->first();
    // dd($pegawaidetail);

    return view('content.employee.employee',[
      'pegawaidetail' => $pegawaidetail,
    ]);
  }

  public function create()
  {
    $jabatan = Department::get();
    $golongan = Golongan::get();

    return view('content.employee.create', [
      'jabatan' => $jabatan,
      'golongan' => $golongan,
    ]);
  }

  public function addPegawai(Request $request)
  {
    // Validasi data dari form
    $request->validate([
      'nama' => 'required',
      'nip' => 'required',
      'phone' => 'required',
      'email' => 'required|email',
      'jabatan' => 'required',
    ]);

    // Simpan data ke database B (tabel user)
    $username = Str::lower(Str::substr($request->nama, 0, 3)) . Str::substr($request->nip, 0, 2);
    $password = Str::substr($request->nip, 0, 6);

    $user = new User;
    $user->username = $username;
    $user->password = bcrypt($password);
    $user->role = 'pegawai';
    $user->save();

    // Simpan data ke database A (tabel pegawai)
    $pegawai = new Employee;
    $pegawai->nama = $request->nama;
    $pegawai->nip = $request->nip;
    $pegawai->phone = $request->phone;
    $pegawai->email = $request->email;
    $pegawai->department_id = $request->jabatan;
    $pegawai->golongan_id = $request->golongan;
    $pegawai->user_id = $user->id;
    $pegawai->save();

    // Redirect atau berikan respons sesuai kebutuhan
    return redirect()->back()->with('success', 'Pegawai berhasil ditambahkan.');
  }
}
