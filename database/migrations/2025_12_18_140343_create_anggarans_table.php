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
    Schema::create('anggarans', function (Blueprint $table) {
        $table->id();
        $table->string('nama_anggaran');
        $table->string('kategori');
        $table->decimal('jumlah_anggaran', 15, 2);
        $table->string('periode'); // contoh: 2025-01
        $table->text('keterangan')->nullable();
        $table->timestamps();
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('anggarans');
    }
};
