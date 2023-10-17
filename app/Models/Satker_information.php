<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Satker_information extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $table = 'satker_information';

    protected $fillable = [
        'nama_satker',
        'alamat_satker',
        'website_satker',
        'pimpinan_satker',
        'wilayah_satker',
        'phone_satker',
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
