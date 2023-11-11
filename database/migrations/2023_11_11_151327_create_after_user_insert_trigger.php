<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // need to create trigger that will insert new row in 'profiles' table after new user will be inserted in 'users' table
        DB::unprepared('
            CREATE TRIGGER after_users_insert
            AFTER INSERT ON users
            FOR EACH ROW
            BEGIN
                INSERT INTO profiles (id, first_name, last_name, created_at) VALUES (NEW.id, NEW.login, \'Default\', NOW());
            END;
        ');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::unprepared('DROP TRIGGER IF EXISTS after_users_insert');
    }
};
