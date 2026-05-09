<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\UnitKerja;

class UnitKerjaSeeder extends Seeder
{
    public function run(): void
    {
        UnitKerja::insert([
            [
                'nama_unit' => 'IT',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_unit' => 'Keuangan',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_unit' => 'SDM',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_unit' => 'Pelayanan',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}