<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $table = 'departments';

    protected $fillable = [
        'nama_jabatan',
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
    public function children()
    {
        return $this->hasMany(Department::class, 'parent_id', 'id');
    }

    public function parent()
    {
        return $this->belongsTo(Department::class, 'parent_id', 'id');
    }
    // Relasi untuk mendapatkan semua pegawai yang memiliki jabatan ini
    public function employee()
    {
        return $this->hasMany(Employee::class, 'id');
    }
}
