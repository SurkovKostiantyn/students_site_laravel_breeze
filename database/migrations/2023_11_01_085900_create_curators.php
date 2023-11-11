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
        Schema::create('curators', function (Blueprint $table) {
            $table->id('curator_id');
            $table->unsignedBigInteger('id')->nullable('false');
            $table->unsignedBigInteger('teacher_id')->nullable('false');
            $table->unsignedBigInteger('group_id')->nullable('false');
            $table->timestamps();

            $table->foreign('id')
                ->references('id')
                ->on('users')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->foreign('teacher_id')
                ->references('teacher_id')
                ->on('teachers')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table->foreign('group_id')
                ->references('group_id')
                ->on('groups')
                ->onDelete('cascade')
                ->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('curators');
    }
};
