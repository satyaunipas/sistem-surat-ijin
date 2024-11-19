<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Jurusan;
use App\Models\Prodi;

class SuperAdminController extends Controller
{
    public function index()
    {      
        // Menghitung jumlah user berdasarkan role
        $jumlahDosen = User::where('role', 'dosen')->count();
        $jumlahMahasiswa = User::where('role', 'mahasiswa')->count();

        // Menghitung jumlah jurusan dan prodi
        $jumlahJurusan = Jurusan::count();
        $jumlahProdi = Prodi::count();

        // Mengirimkan data ke view
        return view('super_admin.dashboard', compact('jumlahDosen', 'jumlahMahasiswa', 'jumlahJurusan', 'jumlahProdi'));
    }
}
