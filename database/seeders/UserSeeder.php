<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Buat 8 dosen
        User::factory()->count(8)->dosen()->create();

        // Buat 2 admin
        User::factory()->count(2)->admin()->create();

        // Buat 1 super admin
        User::factory()->superAdmin()->create(); // Super Admin

        // Buat 40 mahasiswa (total 50 user)
        User::factory()->count(300)->create([
            'role' => 'mahasiswa'
        ]);
    }
}