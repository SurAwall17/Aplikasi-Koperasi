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
        Schema::create('pengajuans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('userId')->constrained('users')->cascadeOnDelete();
            $table->foreignId('kategoriId')->constrained('kategori_koperasis')->cascadeOnDelete();
            $table->date('tgl_pengajuan');
            $table->string('no_npak');
            $table->string('nama_koperasi');
            $table->string('alamat_koperasi');
            $table->decimal('simpanan_pokok', 10, 2);
            $table->decimal('simpanan_wajib', 10, 2);
            $table->string('jumlah_pengurus');
            $table->string('nama_ketua');
            $table->string('nama_wakil');
            $table->string('nama_sekretaris');
            $table->string('nama_bendahara');
            $table->string('pengawas');
            $table->string('rencana_kegiatan');
            $table->string('data_npak');
            $table->string('status')->default('Menunggu Konfirmasi');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pengajuans');
    }
};
