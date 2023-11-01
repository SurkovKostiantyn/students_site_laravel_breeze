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
        Schema::create('librarians', function (Blueprint $table) {
            $table->id('librarian_id');
            $table->unsignedBigInteger('user_id')->nullable('false');
            $table->timestamps();

            $table->foreign('user_id')
                ->references('user_id')
                ->on('user_profiles')
                ->onDelete('cascade')
                ->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('librarians');
    }
};
