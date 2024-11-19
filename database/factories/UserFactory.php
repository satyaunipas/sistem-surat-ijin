<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\Jurusan;
use App\Models\Prodi;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->name(),
            'username' => $this->faker->unique()->userName(), // Menambahkan username
            'nomor_induk' => $this->faker->unique()->randomNumber(8), // Menambahkan nomor induk
            'alamat' => $this->faker->address(), // Alamat lengkap
            'email' => $this->faker->unique()->userName() . '@mail.com', // Email dengan domain @mail.com
            'password' => Hash::make('password'), // Default password
            'role' => 'mahasiswa', // Default role mahasiswa
            'phone_number' => $this->faker->phoneNumber(),
            'jurusan_id' => Jurusan::inRandomOrder()->first()->id, // Pilih jurusan acak dari tabel jurusan
            'program_study_id' => Prodi::inRandomOrder()->first()->id, // Pilih program studi acak
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }

   /**
     * State for dosen role.
     */
    public function dosen(): Factory
    {
        return $this->state(function (array $attributes) {
            return [
                'role' => 'dosen',
            ];
        });
    }

    /**
     * State for admin role.
     */
    public function admin(): Factory
    {
        return $this->state(function (array $attributes) {
            return [
                'role' => 'admin',
            ];
        });
    }

    public function superAdmin()
    {
        return $this->state([
            'role' => 'super_admin',
        ]);
    }
}
