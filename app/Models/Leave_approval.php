<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Leave_approval extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $table = 'leave_approvals';

    protected $fillable = [
      'leave_id',
      'user_id',
      'catatan',
      'status_approval',
      'tanggal_approval'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
}
