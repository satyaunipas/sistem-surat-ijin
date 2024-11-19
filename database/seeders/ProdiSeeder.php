<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProdiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('program_studies')->insert([
            ['jurusan_id' => 1, 'name' => 'D3 Akuntansi'],
            ['jurusan_id' => 1, 'name' => 'D4 Akuntansi Manajerial'],
            ['jurusan_id' => 1, 'name' => 'D4 Akuntansi Perpajakan'],
            ['jurusan_id' => 1, 'name' => 'D2 Administrasi Perpajakan Akuntansi'],

             // Jurusan Teknologi Informasi
            ['jurusan_id' => 2, 'name' => 'D4 Rekayasa Perangkat Lunak'],

            // Jurusan Teknik Elektro
            ['jurusan_id' => 3, 'name' => 'D3 Teknik Elektro'],
        ]);
    }
}
