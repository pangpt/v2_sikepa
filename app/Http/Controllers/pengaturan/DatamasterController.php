<?php

namespace App\Http\Controllers\pengaturan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Satker_information;
use App\Models\Department;
use App\Models\Golongan;
use App\Models\Atasan;
use App\Models\Employee;
use Illuminate\Support\Str;
use App\Models\User;

class DatamasterController extends Controller
{
  public function jabatanIndex()
  {
    $jabatan = Department::get();

    return view('content.datamaster.jabatan', [
      'jabatan' => $jabatan,
    ]);
  }

  public function strukturalIndex()
  {
    $struktural = Atasan::get();
    $employee = Employee::get();
    $jabatan = Department::get();

    return view('content.datamaster.atasan', [
      'struktural' => $struktural,
      'jabatan' => $jabatan,
      'employee' => $employee
    ]);
  }

  public function jabatanCreate(Request $request)
  {
    $jabatan = new Department();
    $jabatan->nama_jabatan = $request->nama_jabatan;
    $jabatan->parent_id = $request->parent_id;
    $jabatan->deskripsi = $request->deskripsi;
    $jabatan->kategori = $request->kategori;
    $jabatan->is_atasan = $request->is_atasan;
    $jabatan->slug = $request->slug;
    $jabatan->save();

    return response()->json(['message' => 'Data jabatan berhasil disimpan.']);
  }

  public function strukturalCreate(Request $request)
  {
    $struk = new Atasan();
    $struk->nama = $request->nama;
    $struk->department_id = $request->department_id;
    $struk->save();

    return response()->json(['message' => 'Data Pejabat Struktural berhasil disimpan.']);

  }

  public function create(Request $request)
  {
    $satker = Satker_information::firstOrFail();
    if(!$satker) {
      $satuanKerja = new Satker_information();
      $satuanKerja->nama_satker = $request->nama_satker;
      $satuanKerja->alamat_satker = $request->alamat_satker;
      $satuanKerja->phone_satker = $request->phone_satker;
      $satuanKerja->wilayah_satker = $request->wilayah_satker;
      $satuanKerja->pimpinan_satker = $request->pimpinan_satker;
      $satuanKerja->website_satker = $request->website_satker;
      $satuanKerja->save();
    } else {
      $satuanKerja = Satker_information::first();
      $satuanKerja->nama_satker = $request->nama_satker;
      $satuanKerja->alamat_satker = $request->alamat_satker;
      $satuanKerja->phone_satker = $request->phone_satker;
      $satuanKerja->wilayah_satker = $request->wilayah_satker;
      $satuanKerja->pimpinan_satker = $request->pimpinan_satker;
      $satuanKerja->website_satker = $request->website_satker;
      $satuanKerja->update();
    }

    return response()->json(['message' => 'Data Satuan Kerja berhasil disimpan.']);

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
