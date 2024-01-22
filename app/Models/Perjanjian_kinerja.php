<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Perjanjian_kinerja extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $table = 'perjanjian_kinerja';

    protected $fillable = [
        'penilaian_kinerja_id',
        'sasaran_kegiatan',
        'indikator',
        'satuan',
        'target_kuantitas',
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

     public function capaian_kinerja()
    {
        return $this->hasMany(Capaian_kinerja::class);
    }

    // Di dalam model Perjanjian_kinerja
    public function getRataRataNilaiCapaianAttribute()
    {
      return $this->capaian_kinerja()->where('periode_pck_id', $this->periode_pck_id)->avg('nilai_capaian');
    }

}
