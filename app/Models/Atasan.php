<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Atasan extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $table = 'atasan';

    protected $fillable = [
        'nama',
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
}
