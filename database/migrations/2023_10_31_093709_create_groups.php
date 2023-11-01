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
        Schema::create('groups', function (Blueprint $table) {
            $table->id('group_id')->autoIncrement();
            $table->unsignedBigInteger('depart_id');
            $table->string('group_name')->unique();
            $table->date('year');
            $table->string('info')->nullable();
            // need to set constraints
            $table->foreign('depart_id')
                ->references('depart_id')
                ->on('departments')
                ->onDelete('cascade')
                ->onUpdate('cascade');
        });
        // need to print this SQL
        // ALTER TABLE groups
        // ADD CONSTRAINT fk_depart_id
        // FOREIGN KEY (depart_id)
        // REFERENCES departments
        // (depart_id)
        // ON DELETE CASCADE
        // ON UPDATE CASCADE;
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('groups');
    }
};
