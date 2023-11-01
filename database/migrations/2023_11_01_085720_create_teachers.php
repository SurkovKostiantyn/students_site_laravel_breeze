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
        Schema::create('teachers', function (Blueprint $table) {
            $table->id('teacher_id');
            $table->unsignedBigInteger('profile_id')->nullable('false');
            $table->unsignedBigInteger('depart_id')->nullable('false');
            $table->timestamps();

            $table->foreign('profile_id')
                ->references('profile_id')
                ->on('user_profiles')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table->foreign('depart_id')
                ->references('depart_id')
                ->on('departments')
                ->onDelete('cascade')
                ->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('teachers');
    }
};
