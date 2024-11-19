<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Letter extends Model
{
    use HasFactory;

    protected $table = 'letters';
    protected $fillable = [
        'user_id',
        'penerima_id',
        'letter_type_id',
        'tempat_surat',
        'letter_content',
        'request_date',
        'status',
        'stamps',
        // tambahkan kolom lain yang diizinkan untuk mass assignment
    ];

    // Relasi dengan User
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    // Relasi dengan LetterType (Jenis Surat)
    public function letterType()
    {
        return $this->belongsTo(LetterType::class, 'letter_type_id');
    }

    // Relasi dengan LetterAttachment
    public function attachments()
    {
        return $this->hasMany(LetterAttachment::class);
    }

    public function penerima()
    {
        return $this->belongsTo(User::class, 'penerima_id');
    }

    public function leaveRequest()
    {
        return $this->hasOne(LeaveRequest::class);
    }

    public function approvals()
    {
        return $this->hasMany(LetterApproval::class);
    }
}