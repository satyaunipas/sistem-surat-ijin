<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Jurusan;
use App\Models\Prodi;
use App\Models\Letter;

class AdminController extends Controller
{
    public function index()
    {      
        // Ambil jurusan_id dari admin yang login
        $adminJurusanId = auth()->user()->jurusan_id;

        // Menghitung jumlah dosen sesuai jurusan admin yang login
        $jumlahDosen = User::where('role', 'dosen')
                            ->where('jurusan_id', $adminJurusanId)
                            ->count();

        // Menghitung jumlah mahasiswa sesuai jurusan admin yang login
        $jumlahMahasiswa = User::where('role', 'mahasiswa')
                                ->where('jurusan_id', $adminJurusanId)
                                ->count();

        // Menghitung jumlah prodi sesuai jurusan admin yang login
        $jumlahProdi = Prodi::where('jurusan_id', $adminJurusanId)
                            ->count();

        // Count the number of letters in the admin's department
        $jumlahSurat = Letter::whereHas('user', function ($query) use ($adminJurusanId) {
            $query->where('jurusan_id', $adminJurusanId);
        })
        ->count();

        // Mengirimkan data ke view
        return view('admin.dashboard', compact('jumlahDosen', 'jumlahMahasiswa', 'jumlahProdi', 'jumlahSurat'));
    }
}
