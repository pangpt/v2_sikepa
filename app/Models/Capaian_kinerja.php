<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Capaian_kinerja extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $table = 'capaian_kinerja';

    protected $fillable = [
        'penilaian_kinerja_id',
        'perjanjian_kinerja_id',
        'indikator_pkp_id',
        'indikator_pck_id',
        'periode_pck_id',
        'target_output',
        'target_mutu',
        'realisasi_output',
        'realisasi_mutu',
        'nilai_capaian',
        'bukti_dukung',
        'status_pck',
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

     // Relasi ke model Employee untuk pejabat penilai
    public function pejabatPenilai()
    {
        return $this->belongsTo(Employee::class, 'pejabat_penilai', 'nip');
    }

     public function indikator_pkp()
     {
      return $this->belongsTo('App\Models\Indikator_pkp', 'indikator_pkp_id', 'id');
     }

     public function indikator_pck()
     {
      return $this->belongsTo('App\Models\Indikator_pck', 'indikator_pck_id', 'id');
     }

     public function perjanjian_kinerja()
    {
        return $this->belongsTo(Perjanjian_kinerja::class);
    }

    public function penilaian_kinerja()
    {
        return $this->belongsTo(Penilaian_kinerja::class);
    }

    public function periode_pck()
    {
        return $this->belongsTo(Periode_pck::class);
    }
}
