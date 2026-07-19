<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class ChangeUserPassword extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'user:password {nip : NIP dari user} {--p= : Password baru}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Ganti password user berdasarkan NIP';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $nip = $this->argument('nip');
        $password = $this->option('p');

        if (!$password) {
            $this->error('Password harus diisi menggunakan opsi --p (contoh: --p rahasia).');
            return Command::FAILURE;
        }

        $user = User::where('nip', $nip)->first();

        if (!$user) {
            $this->error("User dengan NIP {$nip} tidak ditemukan.");
            return Command::FAILURE;
        }

        $user->password = Hash::make($password);
        $user->save();

        $this->info("Password untuk user dengan NIP {$nip} berhasil diubah.");
        
        return Command::SUCCESS;
    }
}
