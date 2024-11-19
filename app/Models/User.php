<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasFactory;

    protected $guarded = ['id'];

    // Relasi dengan tabel Jurusan
    public function jurusan()
    {
        return $this->belongsTo(Jurusan::class, 'jurusan_id');
    }

    // Relasi dengan tabel Prodi
    public function prodi()
    {
        return $this->belongsTo(Prodi::class, 'program_study_id');
    }

    // Relasi dengan tabel Letters
    public function letters()
    {
        return $this->hasMany(Letter::class);
    }

    // Relasi dengan leave_requests
    public function leaveRequests()
    {
        return $this->hasMany(LeaveRequest::class);
    }

    // setiap route mencari username bukan id
    public function getRouteKeyName()
    {
        return 'username';
    }

    public function approvals()
    {
        return $this->hasMany(LetterApproval::class, 'approved_by');
    }
}