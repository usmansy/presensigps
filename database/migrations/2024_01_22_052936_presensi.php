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
        Schema::create('presensi', function (Blueprint $table){
            $table->id();
            $table->string('username', 50);
            $table->date('tgl_presensi');
            $table->time('jam_in');
            $table->time('jam_out');
            $table->string('foto_in', 255);
            $table->string('foto_out', 255);
            $table->text('location_in');
            $table->text('location_out');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::drop('presensi');
    }
};
