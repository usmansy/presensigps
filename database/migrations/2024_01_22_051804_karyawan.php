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
        Schema::create('karyawan', function (Blueprint $table){
            $table->id();
            $table->string('nik', 20);
            $table->string('username', 50);
            $table->string('nama_lengkap', 255);
            $table->string('jabatan', 255);
            $table->string('no_hp', 13);
            $table->string('password', 255);
            $table->string('remember_token', 255)->nullable();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::drop('karyawan');
    }
};
