<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $now = \Carbon\Carbon::now();

      DB::table('users')->insert([
          [
              'username' => 'admin',
              'password' => bcrypt('password'),
              'role' => 'admin',
              'created_at' => $now,
              'updated_at' => $now
          ],
      ]);
    }
}
