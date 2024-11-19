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
        Schema::create('leave_requests', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users'); // Hubungan ke tabel pengguna (mahasiswa)
            $table->foreignId('letter_id')->constrained('letters')->onDelete('cascade'); // Hubungan ke tabel pengguna (mahasiswa)
            $table->string('tempat_surat')->nullable();
            $table->date('leave_date'); // Tanggal permintaan izin
            $table->enum('leave_type', ['sakit', 'ijin', 'dispen']); // Jenis izin (sakit, izin, dispensasi)
            $table->string('reason')->nullable();; // Alasan permohonan izin
            $table->string('nama_ortu')->nullable(); // Nama orang tua siswa
            $table->string('status')->default('pending'); // Status permohonan (pending, approved, rejected)
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('leave_requests');
    }
};
