<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class SyncLegacyUserRole extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'user:sync-roles
                            {--dry-run : Preview saja tanpa mengubah data}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Migrate legacy id_role in users table to role_user pivot table';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $isDryRun = $this->option('dry-run');

        if ($isDryRun) {
            $this->warn('[DRY RUN] Mode preview aktif - tidak ada perubahan yang akan disimpan.');
        }

        $this->info('Memulai sinkronisasi id_role lama ke tabel role_user...');

        // Ambil valid role IDs langsung dari tabel roles
        $validRoleIds = DB::table('roles')->pluck('id_role')->toArray();
        $this->info('Valid role IDs yang tersedia: ' . implode(', ', $validRoleIds));

        // Gunakan DB::table langsung untuk menghindari accessor getIdRoleAttribute()
        // yang membaca dari relasi, bukan dari kolom langsung di tabel users
        $users = DB::table('users')->whereNotNull('id_role')->get();

        $this->info("Ditemukan {$users->count()} user dengan id_role lama (kolom legacy).");
        $this->newLine();

        $synced  = 0;
        $skipped = 0;
        $failed  = 0;

        foreach ($users as $userRow) {
            $legacyIdRole = $userRow->id_role;

            // Lewati jika id_role tidak valid (tidak ada di tabel roles)
            if (!in_array($legacyIdRole, $validRoleIds)) {
                $this->warn("  [SKIP]  nip={$userRow->nip} | id_role={$legacyIdRole} tidak ada di tabel roles.");
                $skipped++;
                continue;
            }

            // Cek apakah relasi sudah ada di role_user
            $alreadyExists = DB::table('role_user')
                ->where('id_user', $userRow->id_user)
                ->where('id_role', $legacyIdRole)
                ->exists();

            if ($alreadyExists) {
                $this->line("  [EXISTS] nip={$userRow->nip} | role {$legacyIdRole} sudah ada di pivot.");
                if (!$isDryRun) {
                    // Relasi sudah ada, aman untuk null-kan kolom lama
                    DB::table('users')->where('id_user', $userRow->id_user)->update(['id_role' => null]);
                }
                $synced++;
                continue;
            }

            if ($isDryRun) {
                $this->info("  [AKAN SYNC] nip={$userRow->nip} | id_role={$legacyIdRole} → akan dipindah ke role_user");
                $synced++;
                continue;
            }

            // ======================================================
            // LANGKAH 1: Insert ke role_user TERLEBIH DAHULU
            // ======================================================
            try {
                DB::table('role_user')->insertOrIgnore([
                    'id_user' => $userRow->id_user,
                    'id_role' => $legacyIdRole,
                ]);
            } catch (\Exception $e) {
                $this->error("  [GAGAL] nip={$userRow->nip} | Error saat insert: " . $e->getMessage());
                $failed++;
                continue;
            }

            // ======================================================
            // LANGKAH 2: Verifikasi insert benar-benar berhasil
            // BARU kemudian hapus id_role lama
            // ======================================================
            $verified = DB::table('role_user')
                ->where('id_user', $userRow->id_user)
                ->where('id_role', $legacyIdRole)
                ->exists();

            if ($verified) {
                // Insert terkonfirmasi, aman untuk null-kan kolom lama
                DB::table('users')->where('id_user', $userRow->id_user)->update(['id_role' => null]);
                $this->info("  [OK]    nip={$userRow->nip} | id_role={$legacyIdRole} berhasil dipindah ke role_user.");
                $synced++;
            } else {
                // Insert gagal — jangan sentuh id_role, data tetap aman
                $this->error("  [GAGAL] nip={$userRow->nip} | Insert tidak terverifikasi, id_role TIDAK dihapus.");
                $failed++;
            }
        }

        $this->newLine();
        $this->info("============================");
        $this->info("Selesai! Hasil sinkronisasi:");
        $this->info("  Berhasil disinkronkan  : {$synced}");
        $this->warn("  Dilewati (role invalid) : {$skipped}");
        if ($failed > 0) {
            $this->error("  Gagal                  : {$failed}");
        }
        $this->info("============================");

        return Command::SUCCESS;
    }
}
