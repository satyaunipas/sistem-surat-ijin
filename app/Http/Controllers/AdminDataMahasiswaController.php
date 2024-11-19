<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Jurusan;
use App\Models\Prodi;

class AdminDataMahasiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $adminJurusanId = auth()->user()->jurusan_id; // Ambil jurusan admin yang sedang login
        $mahasiswas = User::where('role', 'mahasiswa')
                  ->where('jurusan_id', $adminJurusanId) // Filter mahasiswa berdasarkan jurusan admin
                  ->get();
        return view('admin.data_mahasiswa', compact('mahasiswas'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Ambil jurusan dan prodi terkait berdasarkan jurusan admin yang login
        $adminJurusanId = auth()->user()->jurusan_id;
        $jurusans = Jurusan::where('id', $adminJurusanId)->get();
        $prodis = Prodi::where('jurusan_id', $adminJurusanId)->get();

        return view('admin.tambah_mahasiswa', compact('jurusans', 'prodis'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name'=>['required', 'min:3', 'max:255'],
            'username'=>['required', 'min:3', 'max:255', 'unique:users'],
            'nomor_induk'=>'required|unique:users',
            'alamat'=>'required',
            'phone_number'=>'required',
            'email'=>'required|email:dns|unique:users',
            'jurusan_id'=>'required',
            'program_study_id'=>'required',
            'password'=>'required|min:5|max:255|confirmed'
        ]);

        // Menambahkan status secara otomatis
        $validatedData['role'] = 'mahasiswa'; // Menetapkan role sebagai mahasiswa
        $validatedData['status'] = 1; // Menetapkan status ke 1 (aktif)
        $validatedData['password'] = Hash::make($validatedData['password']); // Enkripsi password

        User::create($validatedData);

        return redirect('/admin/data-mahasiswa')->with('success', 'Tambah data mahasiswa berhasil!');
    }

    /**
     * Display the specified resource.
     */
    public function show($username)
    {
        $mahasiswa = User::where('username', $username)->first();  // Ambil mahasiswa berdasarkan username
        if (!$mahasiswa) {
            abort(404);  // Jika data tidak ditemukan, tampilkan halaman 404
        }
        return view('admin.detail_mahasiswa', compact('mahasiswa'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($username)
    {
        // Cari mahasiswa berdasarkan username
        $mahasiswa = User::where('username', $username)->firstOrFail();  // Menampilkan error 404 jika tidak ditemukan

        return view('admin.edit_mahasiswa', [
            'jurusans' => Jurusan::all(),
            'prodis' => Prodi::all(),
            'mahasiswa' => $mahasiswa,  // Mengirim data mahasiswa
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $username)
    {
        // Cari mahasiswa berdasarkan username
        $mahasiswa = User::where('username', $username)->firstOrFail();  // Menampilkan error 404 jika tidak ditemukan
        $rules = [
            'name'=>['required', 'min:3', 'max:255'],
            'alamat'=>'required',
            'phone_number'=>'required',
            'jurusan_id'=>'required',
            'program_study_id'=>'required'
        ];

        // Validasi unik untuk 'username' jika ada perubahan
        if ($request->username != $mahasiswa->username) {
            $rules['username'] = ['required', 'min:3', 'max:255', 'unique:users,username,' . $mahasiswa->id];
        }

        // Validasi unik untuk 'nomor_induk' jika ada perubahan
        if ($request->nomor_induk != $mahasiswa->nomor_induk) {
            $rules['nomor_induk'] = ['required', 'unique:users,nomor_induk,' . $mahasiswa->id];
        }

        // Validasi unik untuk 'email' jika ada perubahan
        if ($request->email != $mahasiswa->email) {
            $rules['email'] = ['required', 'email', 'unique:users,email,' . $mahasiswa->id];
        }

        // Validasi request berdasarkan aturan
        $validatedData = $request->validate($rules);

        // Jika password diisi, maka update password
        if ($request->filled('password')) {
            $validatedData['password'] = bcrypt($request->password);
        }

        // Update data mahasiswa
        $mahasiswa->update($validatedData);

        return redirect('/admin/data-mahasiswa')->with('success', 'Data mahasiswa berhasil diupdate.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($username)
    {
        $mahasiswa = User::where('username', $username)->first();  // Ambil mahasiswa berdasarkan username
        User::destroy($mahasiswa->id);

        return redirect('/admin/data-mahasiswa')->with('success', 'Berhasil menghapus data mahasiswa!');
    }
}
