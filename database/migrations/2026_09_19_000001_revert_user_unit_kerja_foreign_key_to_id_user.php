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
     * Strategy:
     * 1. Drop OLD FK (to iam_id) - safely, only if it exists.
     * 2. Delete conflicting rows (remap would create duplicate PK).
     * 3. Remap remaining rows: user_id (was iam_id) → id_user.
     * 4. Delete orphan rows (user_id not found in users.id_user).
     * 5. Add NEW FK (to id_user).
     */
    public function up(): void
    {
        // Step 1: Drop old FK only if it exists (defensive)
        $this->dropForeignIfExists('user_unit_kerja', 'user_unit_kerja_user_id_foreign');

        // Step 2: Delete rows that would cause duplicate PK after remap.
        // Case A: user_id matches a users.iam_id, but the target id_user already
        //         has a row in user_unit_kerja for the same unit_kerja_id.
        DB::statement('
            DELETE uk_old
            FROM user_unit_kerja uk_old
            INNER JOIN users u          ON uk_old.user_id = u.iam_id
            INNER JOIN user_unit_kerja uk_exist
                                        ON uk_exist.user_id      = u.id_user
                                       AND uk_exist.unit_kerja_id = uk_old.unit_kerja_id
            WHERE u.iam_id IS NOT NULL
              AND u.id_user != uk_old.user_id
        ');

        // Step 3: Remap user_unit_kerja.user_id from iam_id → id_user.
        DB::statement('
            UPDATE user_unit_kerja uk
            INNER JOIN users u ON uk.user_id = u.iam_id
            SET uk.user_id = u.id_user
            WHERE u.iam_id IS NOT NULL
        ');

        // Step 4: Delete orphan rows (user_id has no match in users.id_user).
        DB::statement('
            DELETE uk
            FROM user_unit_kerja uk
            LEFT JOIN users u ON uk.user_id = u.id_user
            WHERE u.id_user IS NULL
        ');

        // Step 5: Add new FK referencing users.id_user.
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
        // Step 1: Drop FK to id_user (defensive)
        $this->dropForeignIfExists('user_unit_kerja', 'user_unit_kerja_user_id_foreign');

        // Step 2: Delete rows that would cause duplicate PK after reverse-remap.
        DB::statement('
            DELETE uk_old
            FROM user_unit_kerja uk_old
            INNER JOIN users u          ON uk_old.user_id = u.id_user
            INNER JOIN user_unit_kerja uk_exist
                                        ON uk_exist.user_id      = u.iam_id
                                       AND uk_exist.unit_kerja_id = uk_old.unit_kerja_id
            WHERE u.iam_id IS NOT NULL
              AND u.iam_id != uk_old.user_id
        ');

        // Step 3: Remap user_unit_kerja.user_id from id_user → iam_id.
        DB::statement('
            UPDATE user_unit_kerja uk
            INNER JOIN users u ON uk.user_id = u.id_user
            SET uk.user_id = u.iam_id
            WHERE u.iam_id IS NOT NULL
        ');

        // Step 4: Delete rows where iam_id is NULL (can't point to iam_id).
        DB::statement('
            DELETE uk
            FROM user_unit_kerja uk
            LEFT JOIN users u ON uk.user_id = u.iam_id
            WHERE u.iam_id IS NULL
        ');

        // Step 5: Restore FK referencing users.iam_id.
        Schema::table('user_unit_kerja', function (Blueprint $table) {
            $table->foreign('user_id')
                  ->references('iam_id')
                  ->on('users')
                  ->cascadeOnDelete()
                  ->cascadeOnUpdate();
        });
    }

    /**
     * Drop a foreign key only if it currently exists on the table.
     */
    private function dropForeignIfExists(string $table, string $constraintName): void
    {
        $exists = DB::select("
            SELECT CONSTRAINT_NAME
            FROM information_schema.TABLE_CONSTRAINTS
            WHERE TABLE_SCHEMA = DATABASE()
              AND TABLE_NAME   = ?
              AND CONSTRAINT_NAME = ?
              AND CONSTRAINT_TYPE = 'FOREIGN KEY'
        ", [$table, $constraintName]);

        if (!empty($exists)) {
            DB::statement("ALTER TABLE `{$table}` DROP FOREIGN KEY `{$constraintName}`");
        }
    }
};
