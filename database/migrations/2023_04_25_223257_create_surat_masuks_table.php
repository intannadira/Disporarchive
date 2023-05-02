<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('surat_masuk', function (Blueprint $table) {
            $table->id();
            $table->string('no_urut');
            $table->string('dari_instansi');
            $table->string('no_surat');
            $table->string('perihal');
            $table->timestamp('tanggal_surat');
            $table->timestamp('tanggal_terima');
            $table->string('kepada');
            $table->enum('kategori_surat', ['segera', 'sangat-segera', 'biasa']);
            $table->string('isi_disposisi');
            $table->enum('status', ['diajukan','didisposisi','dilaksanakan','diverifikasi-kasubag','diverifikasi_sekdin','selesai']);
            $table->string('lampiran');
            $table->enum('tindakan', ['revisi','diajukan']);
            $table->integer('jabatan_bidang_id');
            $table->integer('karyawan_id');
            $table->enum('tindakan_kadin', ['tindak-lanjut','selesaikan']);
            $table->string('catatan_kadin');
            $table->timestamp('tanggal_penyelesaian');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('surat_masuk');
    }
};
