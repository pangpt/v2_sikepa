<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use DB;

class GolonganSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $now = \Carbon\Carbon::now();

      DB::table('golongan')->insert([
        [
            'jenis_golongan' => 'II/c',
            'pangkat' => 'Pengatur',
            'created_at' => $now,
            'updated_at' => $now,
        ],
        [
          'jenis_golongan' => 'II/d',
          'pangkat' => 'Pengatur Tingkat I',
          'created_at' => $now,
          'updated_at' => $now,
        ],
        [
          'jenis_golongan' => 'III/a',
          'pangkat' => 'Penata Muda',
          'created_at' => $now,
          'updated_at' => $now,
        ],
        [
          'jenis_golongan' => 'III/b',
          'pangkat' => 'Penata Muda Tingkat I',
          'created_at' => $now,
          'updated_at' => $now,
        ],
        [
          'jenis_golongan' => 'III/c',
          'pangkat' => 'Penata',
          'created_at' => $now,
          'updated_at' => $now,
        ],
        [
          'jenis_golongan' => 'III/d',
          'pangkat' => 'Penata Tingkat I',
          'created_at' => $now,
          'updated_at' => $now,
        ],
        [
          'jenis_golongan' => 'IV/a',
          'pangkat' => 'Pembina',
          'created_at' => $now,
          'updated_at' => $now,
        ],
        [
          'jenis_golongan' => 'IV/b',
          'pangkat' => 'Pembina Tingkat I',
          'created_at' => $now,
          'updated_at' => $now,
        ],
        [
          'jenis_golongan' => 'IV/c',
          'pangkat' => 'Pembina Utama Muda',
          'created_at' => $now,
          'updated_at' => $now,
        ],
        [
          'jenis_golongan' => 'IV/d',
          'pangkat' => 'Pembina Utama Madya',
          'created_at' => $now,
          'updated_at' => $now,
        ],
        [
          'jenis_golongan' => 'IV/e',
          'pangkat' => 'Pembina Utama',
          'created_at' => $now,
          'updated_at' => $now,
        ],
    ]);
    }
}
