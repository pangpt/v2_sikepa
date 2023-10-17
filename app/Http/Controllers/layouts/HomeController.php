<?php

namespace App\Http\Controllers\layouts;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class HomeController extends Controller
{
  public function changeUserRole(Request $request)
  {
    $newRole = $request->role;
    $userId = $request->id;

    $roles = User::where('id', $userId)->first();
    // dd($roles);
    $roles->update([
      'role' => $newRole
    ]);

    return response()->json(['success' => true]);
  }
}
