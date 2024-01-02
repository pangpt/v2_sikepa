<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Indikator_pkp extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $table = 'indikator_pkp';

    protected $fillable = [
        'sasaran_kegiatan_id',
        'indikator',
        'tanggal',
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

     public function sasaran_kegiatan()
     {
      return $this->belongsTo('App\Models\Sasaran_kegiatan', 'sasaran_kegiatan_id', 'id');
     }

     public function employee()
     {
      return $this->belongsTo('App\Models\Employee', 'employee_id', 'id');
     }
}
