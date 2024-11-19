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
        Schema::create('letter_approvals', function (Blueprint $table) {
            $table->id();
            $table->foreignId('letter_id')->constrained('letters'); // Hubungan ke tabel surat
            $table->foreignId('approved_by')->nullable()->constrained('users'); // Siapa yang menyetujui (admin/dosen)
            $table->string('approval_status')->default('pending'); // Status persetujuan (pending, approved, rejected)
            $table->text('approval_notes')->nullable(); // Catatan persetujuan
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('letter_approvals');
    }
};
