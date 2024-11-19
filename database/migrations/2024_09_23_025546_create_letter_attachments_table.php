<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
        {
            Schema::create('letter_attachments', function (Blueprint $table) {
                $table->id();
                $table->foreignId('letter_id')->nullable()->constrained('letters'); // Hubungan ke tabel surat
                $table->string('file_path')->nullable(); // Lokasi file di server (misal: uploads/files)
                $table->timestamps();
            });
        }

    public function down()
        {
            Schema::dropIfExists('letter_attachments');
        }
};
