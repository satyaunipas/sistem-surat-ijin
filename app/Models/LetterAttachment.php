<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LetterAttachment extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'letter_id',
        'file_path',
        'stamps'
    ];

    // Relasi dengan Letter
    public function letter()
    {
        return $this->belongsTo(Letter::class);
    }
}