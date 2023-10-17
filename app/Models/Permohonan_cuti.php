<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Permohonan_cuti extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $table = 'permohonan_cuti';

    protected $fillable = [
        'leave_id',
        'sign_permohonan',
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

}
