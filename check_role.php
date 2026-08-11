<?php
$user = App\Models\User::where('nip', '1234567')->first();
if ($user) {
    echo "User NIP 1234567 found. Role: " . ($user->role ?? 'No Role') . "\n";
} else {
    echo "User NIP 1234567 NOT FOUND in database.\n";
}
