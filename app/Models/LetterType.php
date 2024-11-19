<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LetterType extends Model
{
    use HasFactory;

    protected $guard = ['id'];

    // Relasi dengan Letters
    public function letters()
    {
        return $this->hasMany(Letter::class);
    }
}