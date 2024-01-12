<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Penilaian_capaian extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $table = 'penilaian_capaian_kinerja';

    protected $fillable = [
        'penilaian_kinerja_id',
        'periode',
        'status',
        'total_capaian',
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


     public function penilaian_kinerja()
     {
      return $this->belongsTo('App\Models\Penilaian_kinerja', 'penilaian_kinerja_id', 'id');
     }

     public function periode_pck()
     {
      return $this->belongsTo('App\Models\Periode_pck', 'periode_pck_id', 'id');
     }
}
