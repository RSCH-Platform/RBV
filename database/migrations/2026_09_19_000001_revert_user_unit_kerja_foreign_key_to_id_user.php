<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * Reverts the user_unit_kerja.user_id foreign key from referencing
     * users.iam_id back to users.id_user (primary key).
     *
     * Before adding the new FK, we:
     * 1. Remap existing rows: if user_id matches a users.iam_id, replace it
     *    with that user's id_user so no data is lost.
     * 2. Delete any remaining orphan rows (user_id not found in users.id_user)
     *    to satisfy the FK constraint.
     */
    public function up(): void
    {
        // Step 1: Drop the old FK (iam_id reference)
        Schema::table('user_unit_kerja', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
        });

        // Step 2: Remap user_unit_kerja.user_id from iam_id → id_user
        // For every row where user_id equals a user's iam_id, replace it with
        // that user's id_user so the existing unit-kerja assignments are kept.
        DB::statement('
            UPDATE user_unit_kerja uk
            JOIN users u ON uk.user_id = u.iam_id
            SET uk.user_id = u.id_user
            WHERE u.iam_id IS NOT NULL
        ');

        // Step 3: Delete orphan rows where user_id still has no match in users.id_user
        DB::statement('
            DELETE uk FROM user_unit_kerja uk
            LEFT JOIN users u ON uk.user_id = u.id_user
            WHERE u.id_user IS NULL
        ');

        // Step 4: Add new FK referencing users.id_user
        Schema::table('user_unit_kerja', function (Blueprint $table) {
            $table->foreign('user_id')
                  ->references('id_user')
                  ->on('users')
                  ->cascadeOnDelete()
                  ->cascadeOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Step 1: Drop the new FK (id_user reference)
        Schema::table('user_unit_kerja', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
        });

        // Step 2: Remap user_unit_kerja.user_id from id_user → iam_id
        DB::statement('
            UPDATE user_unit_kerja uk
            JOIN users u ON uk.user_id = u.id_user
            SET uk.user_id = u.iam_id
            WHERE u.iam_id IS NOT NULL
        ');

        // Step 3: Delete rows where iam_id mapping is not available (NULL)
        DB::statement('
            DELETE uk FROM user_unit_kerja uk
            LEFT JOIN users u ON uk.user_id = u.iam_id
            WHERE u.iam_id IS NULL
        ');

        // Step 4: Restore old FK referencing users.iam_id
        Schema::table('user_unit_kerja', function (Blueprint $table) {
            $table->foreign('user_id')
                  ->references('iam_id')
                  ->on('users')
                  ->cascadeOnDelete()
                  ->cascadeOnUpdate();
        });
    }
};
