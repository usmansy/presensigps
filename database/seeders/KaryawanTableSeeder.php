<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class KaryawanTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('karyawan')->insert([
            [
                'nik' => '123456',
                'username' => 'admin',
                'nama_lengkap' => 'Administrator',
                'jabatan' => 'Admin',
                'no_hp' => '123456',
                'password' => Hash::make('123'),
            ],
            [
                'nik' => '123457',
                'username' => 'usman',
                'nama_lengkap' => 'Usman Syarifuddin',
                'jabatan' => 'Admin',
                'no_hp' => '123456',
                'password' => Hash::make('123'),
            ],
        ]);
    }
}
