<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
    Schema::create('standar_who_pbu', function (Blueprint $table) {
        $table->id();
        $table->string('jenis_kelamin'); // L / P
        $table->integer('umur_bulan');

        $table->float('minus_3sd');
        $table->float('minus_2sd');
        $table->float('median');     
        $table->float('plus_2sd');
        $table->float('plus_3sd');

        $table->timestamps();
    });
    }

    public function down(): void
    {
        Schema::dropIfExists('standar_who_pbu');
    }
};