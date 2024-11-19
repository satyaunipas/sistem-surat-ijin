<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\LetterType;

class LetterTypeSeeder extends Seeder
{
    public function run()
    {
        // Buat beberapa tipe surat
        LetterType::create([
            'name' => 'Sakit',
            'description' => 'Izin untuk tidak masuk kuliah karena sakit.'
        ]);

        LetterType::create([
            'name' => 'Izin Pribadi',
            'description' => 'Izin untuk tidak masuk kuliah karena urusan pribadi.'
        ]);
    }
}