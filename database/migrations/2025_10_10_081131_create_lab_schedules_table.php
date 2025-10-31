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
        Schema::create('lab_schedules', function (Blueprint $table) {
            $table->id();
            $table->foreignId('lab_simulator_id')->constrained('lab_simulators')->onDelete('cascade');
            $table->foreignId('kalab_id')->nullable()->constrained('users')->onDelete('cascade');
            $table->foreignId('pengajar_id')->nullable()->constrained('users')->onDelete('cascade');
            $table->date('tanggal');
            $table->time('jam_mulai');
            $table->time('jam_selesai');
            $table->string('jenis_kegiatan');           // VARCHAR(255) - cukup
            $table->text('detail_materi');              // TEXT - untuk deskripsi panjang
            $table->integer('jumlah_peserta');
            $table->enum('status_verifikasi', ['Belum Disetujui', 'Disetujui'])->default('Belum Disetujui');
            $table->foreignId('created_by')->constrained('users');
            $table->timestamps();

            // Index untuk optimisasi query
            $table->index(['lab_simulator_id', 'tanggal']);     // Untuk validasi bentrok jadwal
            $table->index(['status_verifikasi']);               // Untuk filter admin
            $table->index(['created_by']);                      // Untuk filter user
            $table->index(['tanggal']);                         // Untuk filter tanggal
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lab_schedules');
    }
};
