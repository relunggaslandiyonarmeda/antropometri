<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('anak', function (Blueprint $table) {
            $table->id();
            $table->string('alamat')->nullable();
            $table->date('tanggal_pengukuran');
            $table->string('nama_orang_tua')->nullable();
            $table->string('nik_anak')->nullable();
            $table->string('nama_anak');
            $table->date('tanggal_lahir');
            $table->integer('umur_bulan');
            $table->string('jenis_kelamin'); // Laki-Laki / Perempuan
            $table->decimal('berat_badan', 5, 2);
            $table->decimal('tinggi_badan', 5, 2);
            $table->decimal('imt', 6, 2)->nullable();
            // Z-Score & Status BB/U
            $table->decimal('zscore_bbu', 6, 2)->nullable();
            $table->string('status_bbu')->nullable();
            // Z-Score & Status TB/U
            $table->decimal('zscore_tbu', 6, 2)->nullable();
            $table->string('status_tbu')->nullable();
            // Z-Score & Status BB/TB
            $table->decimal('zscore_bbtb', 6, 2)->nullable();
            $table->string('status_bbtb')->nullable();
            // Z-Score & Status IMT/U
            $table->decimal('zscore_imtu', 6, 2)->nullable();
            $table->string('status_imtu')->nullable();
            $table->text('keterangan')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('anak');
    }
};
