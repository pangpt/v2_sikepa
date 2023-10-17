<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use DB;

class AtasanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $now = \Carbon\Carbon::now();

      DB::table('atasan')->insert([
          [
              'nama' => 'Dra. Hj. Heriyah, S.H., M.H.',
              'department_id' => '1',
              'created_at' => $now,
              'updated_at' => $now
          ],
          [
              'nama' => 'Lukman Patawari, S.H.',
              'department_id' => '4',
              'created_at' => $now,
              'updated_at' => $now
          ],
          [
            'nama' => 'Muniroh Nahdi, S.H., M.H.',
            'department_id' => '5',
            'created_at' => $now,
            'updated_at' => $now
          ],
          [
            'nama' => 'Bintang, S.H.',
            'department_id' => '8',
            'created_at' => $now,
            'updated_at' => $now
          ],
          [
            'nama' => 'Andi Suardi, S.Ag.',
            'department_id' => '7',
            'created_at' => $now,
            'updated_at' => $now
          ],
          [
            'nama' => 'Hayad Jusa, S.Ag.',
            'department_id' => '6',
            'created_at' => $now,
            'updated_at' => $now
          ],
          [
            'nama' => 'Hj. Asmah, S.H.',
            'department_id' => '10',
            'created_at' => $now,
            'updated_at' => $now
          ],
          [
            'nama' => 'Nurhidayah, S.Ag.',
            'department_id' => '11',
            'created_at' => $now,
            'updated_at' => $now
          ],
          [
            'nama' => 'Ninik Hartini Mansyur, S.H.',
            'department_id' => '9',
            'created_at' => $now,
            'updated_at' => $now
          ],
      ]);
    }
}
