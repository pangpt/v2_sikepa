<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use DB;

class DepartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $now = \Carbon\Carbon::now();

      DB::table('departments')->insert([
        [
            'nama_jabatan' => 'Ketua',
            'deskripsi' => 'Ketua Pengadilan',
            'parent_id' => '1',
            'created_at' => $now,
            'updated_at' => $now,
        ],
        [
          'nama_jabatan' => 'Wakil Ketua',
          'deskripsi' => 'Wakil Ketua Pengadilan',
          'parent_id' => '1',
          'created_at' => $now,
          'updated_at' => $now,
        ],
        [
          'nama_jabatan' => 'Sekretaris',
          'deskripsi' => 'Sekretaris',
          'parent_id' => '1',
          'created_at' => $now,
          'updated_at' => $now,
        ],
        [
          'nama_jabatan' => 'Panitera',
          'deskripsi' => 'Panitera',
          'parent_id' => '1',
          'created_at' => $now,
          'updated_at' => $now,
        ],
        [
          'nama_jabatan' => 'Hakim',
          'deskripsi' => 'Hakim',
          'parent_id' => '1',
          'created_at' => $now,
          'updated_at' => $now,
        ],
        [
          'nama_jabatan' => 'Panitera Muda Hukum',
          'deskripsi' => 'Panitera Muda Hukum',
          'parent_id' => '4',
          'created_at' => $now,
          'updated_at' => $now,
        ],
        [
          'nama_jabatan' => 'Panitera Muda Gugatan',
          'deskripsi' => 'Panitera Muda Gugatan',
          'parent_id' => '4',
          'created_at' => $now,
          'updated_at' => $now,
        ],
        [
          'nama_jabatan' => 'Panitera Muda Permohonan',
          'deskripsi' => 'Panitera Muda Permohonan',
          'parent_id' => '4',
          'created_at' => $now,
          'updated_at' => $now,
        ],
        [
          'nama_jabatan' => 'Kasubag PTIP',
          'deskripsi' => 'Kasubag PTIP',
          'parent_id' => '3',
          'created_at' => $now,
          'updated_at' => $now,
        ],
        [
          'nama_jabatan' => 'Kasubag Ortala',
          'deskripsi' => 'Kasubag Ortala',
          'parent_id' => '3',
          'created_at' => $now,
          'updated_at' => $now,
        ],
        [
          'nama_jabatan' => 'Kasubag Kepegawaian',
          'deskripsi' => 'Kasubag Kepegawaian',
          'parent_id' => '3',
          'created_at' => $now,
          'updated_at' => $now,
        ],
        [
          'nama_jabatan' => 'Panitera Pengganti',
          'deskripsi' => 'Panitera Pengganti',
          'parent_id' => '4',
          'created_at' => $now,
          'updated_at' => $now,
        ],
        [
          'nama_jabatan' => 'Jurusita',
          'deskripsi' => 'Jurusita',
          'parent_id' => '4',
          'created_at' => $now,
          'updated_at' => $now,
        ],
        [
          'nama_jabatan' => 'Pranata Komputer',
          'deskripsi' => 'Pranata Komputer',
          'parent_id' => '3',
          'created_at' => $now,
          'updated_at' => $now,
        ],
        [
          'nama_jabatan' => 'Analis Perkara Peradilan',
          'deskripsi' => 'Analis Perkara Peradilan',
          'parent_id' => '4',
          'created_at' => $now,
          'updated_at' => $now,
        ],
        [
          'nama_jabatan' => 'Pengelola Perkara',
          'deskripsi' => 'Pengelola Perkara',
          'parent_id' => '4',
          'created_at' => $now,
          'updated_at' => $now,
        ],
        [
          'nama_jabatan' => 'Pengelola BMN',
          'deskripsi' => 'Pengelola BMN',
          'parent_id' => '3',
          'created_at' => $now,
          'updated_at' => $now,
        ],
        [
          'nama_jabatan' => 'Analis Perencanaan',
          'deskripsi' => 'Analis Perencanaan',
          'parent_id' => '3',
          'created_at' => $now,
          'updated_at' => $now,
        ],
    ]);
    }
}
