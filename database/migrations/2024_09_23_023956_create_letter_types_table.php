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
            Schema::create('letter_types', function (Blueprint $table) {
                $table->id();
                $table->string('name'); // Nama jenis surat (misal: Surat Izin, Surat Tugas)
                $table->text('description')->nullable(); // Deskripsi jenis surat
                $table->timestamps();
            });
        }

    public function down()
        {
            Schema::dropIfExists('letter_types');
        }
};
