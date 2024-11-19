<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LetterApproval extends Model
{
    use HasFactory;

    protected $fillable = [
        'letter_id',
        'approved_by',
        'approval_status',
        'approval_notes'
    ];

    // Relasi dengan tabel Letter
    public function letter()
    {
        return $this->belongsTo(Letter::class);
    }

    // Relasi dengan tabel User (pemberi persetujuan)
    public function approvedBy()
    {
        return $this->belongsTo(User::class, 'approved_by');
    }
}
