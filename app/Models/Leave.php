<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Leave extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $table = 'leaves';

    // protected $fillable = [
    //     'nama_jabatan',
    // ];

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

     public function atasan()
     {
      return $this->belongsTo('App\Models\Atasan', 'atasan_id', 'id');
     }

     public function persetujuanCuti()
      {
          return $this->hasMany(Leave_approval::class, 'leave_id');
      }

     public function disetujuiKetua()
     {
          // Cek apakah sudah ada entri persetujuan dari Ketua
          $persetujuanKetua = $this->persetujuanCuti()
          ->where('atasan_id', auth()->user()->employee->department->id) // Ganti dengan ID jabatan Ketua
          ->where('status_approval', 1) // Status persetujuan Ketua (sesuaikan dengan status yang sesuai)
          ->count();

          return $persetujuanKetua > 0;
     }

     public function disetujuiAtasanLangsung()
      {
          // Lakukan pengecekan apakah sudah ada persetujuan oleh atasan langsung
          return $this->persetujuanCuti()
              ->where('atasan_id', auth()->user()->employee->department->id) // Sesuaikan dengan cara Anda menghubungkan atasan langsung
              ->where('status_approval', 2) // 1 mewakili status persetujuan yang sudah disetujui
              ->exists(); // Mengembalikan true jika ada persetujuan yang sesuai
      }

      public function diverifikasi()
      {
          // Lakukan pengecekan apakah sudah ada persetujuan oleh atasan langsung
          return $this->persetujuanCuti()
              ->where('atasan_id', auth()->user()->employee->department->id) // Sesuaikan dengan cara Anda menghubungkan atasan langsung
              ->where('status_approval', 3) // 1 mewakili status persetujuan yang sudah disetujui
              ->exists(); // Mengembalikan true jika ada persetujuan yang sesuai
      }
}
