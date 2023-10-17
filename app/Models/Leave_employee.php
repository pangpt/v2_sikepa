<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Leave_employee extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $table = 'leave_employees';

    protected $fillable = [
        'jumlah_cuti',
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

     public function employee()
     {
      return $this->belongsTo('App\Models\Employee', 'employee_id', 'id');
     }
}
