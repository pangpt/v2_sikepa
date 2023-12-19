<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use DB;

class EmployeeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $now = \Carbon\Carbon::now();

      DB::table('employees')->insert([
          [
              'user_id' => '1',
              'department_id' => '1',
              'golongan_id' => '1',
              'nama' => 'Administrator',
              'nip' => '000000',
              'alamat' => 'SEMARANG CITY',
              'jenis_kelamin' => 'Laki-laki',
              'email' => 'administrator@sikepa.go.id',
              'phone' => '000000',
              'created_at' => $now,
              'updated_at' => $now
          ],
      ]);
    }
}
