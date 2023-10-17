<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;


class Employee extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $table = 'employees';

    protected $fillable = [
        'nama',
        'nip',
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

     public function department()
     {
      return $this->belongsTo('App\Models\Department', 'department_id', 'id');
     }

     public function golongan()
     {
      return $this->belongsTo('App\Models\Golongan', 'golongan_id', 'id');
     }

     public function atasan()
     {
      return $this->belongsTo('App\Models\Atasan', 'atasan_id', 'id');
     }

     public function atasanLangsung()
    {
        return $this->belongsTo(Employee::class, 'parent_id');
    }

    public function user()
    {
     return $this->belongsTo('App\Models\User', 'user_id', 'id');
    }

    public function masaKerja()
    {
        // Menghitung selisih tahun dan bulan antara TMT dan saat ini
        $tmt = Carbon::parse($this->tmt); // Gantilah 'tmt' dengan kolom yang sesuai di model Anda
        $now = Carbon::now();

        $years = $now->diffInYears($tmt);
        $months = $now->diffInMonths($tmt) % 12;

        // Format hasil sebagai "x tahun x bulan"
        $result = '';

        if ($years > 0) {
            $result .= $years . ' Tahun';
        }

        if ($months > 0) {
            $result .= ($result ? ' ' : '') . $months . ' Bulan';
        }

        return $result;
    }
}
