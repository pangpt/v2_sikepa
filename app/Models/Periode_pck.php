<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Periode_pck extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $table = 'periode_pck';

    protected $fillable = [
        'penilaian_kinerja_id',
        'periode_bulan',
        'periode_tahun',
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
}
