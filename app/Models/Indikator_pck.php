<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Indikator_pck extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $table = 'indikator_pck';

    protected $fillable = [
        'butir_kegiatan',
        'hasil',
        'employee_id',
        'status',
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
