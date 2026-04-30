<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('balitas', function (Blueprint $table) {
        $table->id();
        $table->string('nama');
        $table->string('nik')->unique();
        $table->string('tempat_lahir');
        $table->date('tanggal_lahir');
        $table->string('nama_ibu');
        $table->foreignId('user_id')->nullable()->constrained()->onDelete('cascade');
        $table->timestamps();
        $table->string('jenis_kelamin');
        $table->string('kondisi')->nullable();
    });
    }

    public function down(): void
    {
        Schema::dropIfExists('balitas');
    }
};