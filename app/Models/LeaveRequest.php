<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LeaveRequest extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'letter_id',
        'tempat_surat',
        'leave_date',
        'leave_type',
        'reason',
        'nama_ortu',
        'status',
        'stamps',
        // tambahkan kolom lain yang diizinkan untuk mass assignment
    ];

    // Relasi dengan User
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function letter()
    {
        return $this->belongsTo(Letter::class);
    }
}