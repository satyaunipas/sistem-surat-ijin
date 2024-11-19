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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->string('email')->unique();
            $table->string('password');
            $table->string('username')->unique(); // kolom username
            $table->string('nomor_induk')->nullable()->unique(); // kolom nomor_induk (NIM/NIP)
            $table->string('alamat')->nullable();
            $table->string('role')->default('mahasiswa'); // peran: mahasiswa/dosen
            $table->string('phone_number')->nullable(); // nomor telepon
            $table->foreignId('jurusan_id')->nullable()->constrained('jurusan'); // Hubungan ke tabel jurusan
            $table->foreignId('program_study_id')->nullable()->constrained('program_studies'); // Hubungan ke tabel prodi
            $table->string('academic_year')->nullable(); // Tahun Ajaran (misal: 2023/2024)
            $table->boolean('status')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
