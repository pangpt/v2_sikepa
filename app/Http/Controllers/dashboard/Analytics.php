<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Employee;
use App\Models\Department;
use App\Models\Information;

class Analytics extends Controller
{
  public function index()
  {
    $info = Information::orderBy('updated_at', 'desc')->get();

    $strukturalSlug = ['sekretaris', 'panitera', 'kasubag'];
    $fungsionalSlug = ['panmud', 'js', 'pp', 'fungsional'];


      $totalHakim = Employee::whereIn('department_id', function ($query) {
        $query->select('id')->from('departments')->where('slug', 'hakim');
      })->count();

      $totalStruktural = Employee::whereIn('department_id', function ($query) use ($strukturalSlug) {
        $query->select('id')->from('departments')->whereIn('slug', $strukturalSlug);
      })->count();

          $totalFungsional = Employee::whereIn('department_id', function ($query) use ($fungsionalSlug) {
            $query->select('id')->from('departments')->whereIn('slug', $fungsionalSlug);
        })->count();



    return view('content.dashboard.dashboards-analytics', [
      'hakimCount' => $totalHakim,
      'strukturalCount' => $totalStruktural,
      'fungsionalCount' => $totalFungsional,
      'info' => $info,
    ]);
  }

}
