<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\UnitKerja;

class UnitKerjaSeeder extends Seeder
{
    public function run(): void
    {
        // Gunakan kolom 'unit_name' (bukan 'nama_unit') sesuai skema tabel unit_kerja saat ini.
        // Kolom 'kabid' sudah ditambahkan kembali via migration 2026_08_11_000001.
        UnitKerja::insert([

            [
                'unit_name' => 'Unit Poliklinik Rawat Jalan',
                'kabid' => 'Kabid Keperawatan',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'unit_name' => 'Instalasi Gawat Darurat',
                'kabid' => 'Kabid Keperawatan',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'unit_name' => 'Unit Rawat Inap Ruang Lotus',
                'kabid' => 'Kabid Keperawatan',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'unit_name' => 'Unit Rawat Inap Ruang Rosalina',
                'kabid' => 'Kabid Keperawatan',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'unit_name' => 'Unit Rawat Inap Ruang Alamanda',
                'kabid' => 'Kabid Keperawatan',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'unit_name' => 'Unit Rawat Inap Ruang Teratai',
                'kabid' => 'Kabid Keperawatan',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'unit_name' => 'Unit Rawat Inap Ruang Anturium',
                'kabid' => 'Kabid Keperawatan',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'unit_name' => 'Unit Rawat Inap Ruang Tulip',
                'kabid' => 'Kabid Keperawatan',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'unit_name' => 'Unit Kamar Operasi',
                'kabid' => 'Kabid Keperawatan',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'unit_name' => 'Unit ICU',
                'kabid' => 'Kabid Keperawatan',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'unit_name' => 'Unit Hemodialisis',
                'kabid' => 'Kabid Keperawatan',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'unit_name' => 'Unit Kamar Bersalin',
                'kabid' => 'Kabid Keperawatan',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'unit_name' => 'Unit Perinatologi',
                'kabid' => 'Kabid Keperawatan',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'unit_name' => 'Unit Radiologi',
                'kabid' => 'Kabid Penunjang Medis',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'unit_name' => 'Unit Laboratorium',
                'kabid' => 'Kabid Penunjang Medis',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'unit_name' => 'Unit Gizi',
                'kabid' => 'Kabid Penunjang Medis',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'unit_name' => 'Unit Farmasi',
                'kabid' => 'Kabid Penunjang Medis',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'unit_name' => 'Unit Rekam Medik',
                'kabid' => 'Kabid Penunjang Medis',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'unit_name' => 'Unit Umum Rumah Tangga',
                'kabid' => 'Kabag Umum & Keuangan',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'unit_name' => 'Unit Informasi & TI',
                'kabid' => 'Kabag Umum & Keuangan',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'unit_name' => 'Unit Keuangan',
                'kabid' => 'Kabag Umum & Keuangan',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'unit_name' => 'Unit Pajak',
                'kabid' => 'Kabag Umum & Keuangan',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'unit_name' => 'Unit Akuntansi',
                'kabid' => 'Kabag Umum & Keuangan',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'unit_name' => 'Unit Kepegawaian & Diklat',
                'kabid' => 'Kabag Umum & Keuangan',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'unit_name' => 'Unit Sekretariat',
                'kabid' => 'Sekretariat',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'unit_name' => 'Unit Direksi',
                'kabid' => 'Direksi',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}