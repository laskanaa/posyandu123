<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
    Schema::create('penimbangans', function (Blueprint $table) {
        $table->id();
        $table->foreignId('balita_id')->constrained()->onDelete('cascade');
        $table->date('tanggal_penimbangan');
        $table->float('berat_badan');
        $table->float('tinggi_badan');
        $table->float('lila');
        $table->float('lika');
        $table->timestamps();
    });
    }

    public function down(): void
    {
        Schema::dropIfExists('penimbangans');
    }
};