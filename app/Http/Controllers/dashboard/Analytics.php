<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Employee;
use App\Models\Department;

class Analytics extends Controller
{
  public function index()
  {
    // Cari departemen dengan nama 'hakim'
    $hakim = Department::where('slug', 'hakim')->first();


    // Jika departemen 'hakim' ditemukan, hitung jumlah pegawai dengan department_id yang sesuai
    if($hakim) {
      $hakimCount = Employee::where('department_id', $hakim->id)->count();
    } else {
      $hakimCount = 0;
    }


    return view('content.dashboard.dashboards-analytics', [
      'hakimCount' => $hakimCount,
    ]);
  }
}
