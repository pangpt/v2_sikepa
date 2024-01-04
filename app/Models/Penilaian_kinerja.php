<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Penilaian_kinerja extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $table = 'penilaian_kinerja';

    protected $fillable = [
        'indikator_pkp_id',
        'employee_id',
        'satuan',
        'target_kuantitas',
        'periode_mulai',
        'periode_selesai',
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
}
