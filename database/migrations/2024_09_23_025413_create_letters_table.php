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
        Schema::create('letters', function (Blueprint $table) {
            $table->id(); // Primary key
            $table->foreignId('user_id')->constrained('users'); // Foreign key ke tabel users
            $table->foreignId('penerima_id')->constrained('users'); // Foreign key ke tabel users
            $table->foreignId('letter_type_id')->constrained('letter_types'); // Foreign key ke tabel letter_types
            $table->string('tempat_surat')->nullable();
            $table->text('letter_content')->nullable(); // Isi surat
            $table->date('request_date'); // Tanggal permintaan
            $table->string('status')->default('pending'); // Status surat
            $table->timestamps(); // Created_at dan updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('letters');
    }
};
