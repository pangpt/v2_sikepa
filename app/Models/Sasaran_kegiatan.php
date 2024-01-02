<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sasaran_kegiatan extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $table = 'sasaran_kegiatan';

    protected $fillable = [
        'sasaran_kegiatan_text',
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
    public function indikator_pkp()
     {
      return $this->belongsTo('App\Models\Indikator_pkp', 'sasaran_kegiatan_id', 'id');
     }
}
