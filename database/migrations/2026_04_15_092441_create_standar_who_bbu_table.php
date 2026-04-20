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
    Schema::create('standar_who_bbu', function (Blueprint $table) {
        $table->id();
        $table->string('jenis_kelamin');
        $table->integer('umur_bulan');
        $table->float('l');
        $table->float('m');
        $table->float('s');
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('standar_who_bbu');
    }
};