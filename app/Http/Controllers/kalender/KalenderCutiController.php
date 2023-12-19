<?php

namespace App\Http\Controllers\kalender;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Leave;

class KalenderCutiController extends Controller
{
    //
    public function index()
    {
      $cuti_approve = Leave::where('status_permohonan', 3)->get();

      return view('content.kalender.index', [
        'cuti' => $cuti_approve,
      ]);
    }
}
