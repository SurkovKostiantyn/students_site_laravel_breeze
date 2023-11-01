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
        Schema::create('user_profiles', function (Blueprint $table) {
            $table->id('profile_id'); // Автоінкрементне поле, що відповідає `profile_id`
            $table->unsignedBigInteger('user_id');
            $table->string('first_name', 255)->nullable();
            $table->string('last_name', 255)->nullable();
            $table->unsignedBigInteger('group_id');
            $table->unsignedBigInteger('depart_id');

            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->foreign('group_id')
                ->references('group_id')
                ->on('groups')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->foreign('depart_id')
                ->references('depart_id')
                ->on('departments')
                ->onDelete('no action')
                ->onUpdate('no action');

            $table->unique('user_id');
            $table->unique('group_id');
            $table->unique('depart_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_profiles');
    }
};
