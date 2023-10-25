<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // change id column to type integer
        Schema::table('users', function (Blueprint $table) {
            $table->integer('id')->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // rollback changes
        Schema::table('users', function (Blueprint $table) {
            $table->string('id')->change();
        });
    }
};
