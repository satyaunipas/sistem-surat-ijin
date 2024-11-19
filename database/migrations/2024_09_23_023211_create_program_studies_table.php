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
            Schema::create('program_studies', function (Blueprint $table) {
                $table->id();
                $table->foreignId('jurusan_id')->constrained('jurusan');
                $table->string('name');
                $table->timestamps();
            });
        }

    public function down()
        {
            Schema::dropIfExists('program_studies');
        }
};
