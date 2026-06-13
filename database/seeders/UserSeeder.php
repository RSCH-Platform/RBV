<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('users')->insert([
            [
                'NIK' => '1234567',
                'nama_lengkap' => 'Super Admin',
                'id_role' => 1,
                'id_jabatan' => 1,
                'id_unit_kerja' => 1,
                'password' => Hash::make('superadmin123'),
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'NIK' => '12345',
                'nama_lengkap' => 'Admin',
                'id_role' => 2,
                'id_jabatan' => 2,
                'id_unit_kerja' => 1,
                'password' => Hash::make('admin123'),
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'NIK' => '1234',
                'nama_lengkap' => 'Sekretaris',
                'id_role' => 3,
                'id_jabatan' => 4,
                'id_unit_kerja' => 33,
                'password' => Hash::make('sekretaris123'),
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'NIK' => '123',
                'nama_lengkap' => 'Karyawan',
                'id_role' => 4,
                'id_jabatan' => 5,
                'id_unit_kerja' => 30,
                'password' => Hash::make('karyawan123'),
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}