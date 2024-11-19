<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jurusan extends Model
{
    use HasFactory;

    protected $table = 'jurusan';
    protected $guarded = ['id'];

    // Relasi dengan User
    public function users()
    {
        return $this->hasMany(User::class);
    }

    // Relasi dengan model Prodi
    public function prodi()
    {
        return $this->hasMany(Prodi::class);
    }

    // Jurusan.php (Model)
    public function admin()
    {
        return $this->hasOne(User::class, 'jurusan_id')->where('role', 'admin');
    }
}