<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Tambahkan kolom kabid ke tabel unit_kerja.
     *
     * Kolom ini sebelumnya ada di tabel unit_kerjas (lama) dan hilang
     * saat migrasi ke tabel unit_kerja (baru/nexaid). View dan seeder
     * masih membutuhkannya untuk mengelompokkan unit berdasarkan kabid.
     */
    public function up(): void
    {
        Schema::table('unit_kerja', function (Blueprint $table) {
            if (!Schema::hasColumn('unit_kerja', 'kabid')) {
                $table->string('kabid')->nullable()->after('unit_name');
            }
        });
    }

    public function down(): void
    {
        Schema::table('unit_kerja', function (Blueprint $table) {
            if (Schema::hasColumn('unit_kerja', 'kabid')) {
                $table->dropColumn('kabid');
            }
        });
    }
};
