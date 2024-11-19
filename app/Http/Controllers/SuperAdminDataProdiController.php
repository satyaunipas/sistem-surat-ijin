<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Jurusan;
use App\Models\Prodi;

class SuperAdminDataProdiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Ambil semua prodi beserta relasi jurusan
        $prodis = Prodi::with('jurusan')->get();

        return view('super_admin.data_prodi', compact('prodis'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view ('super_admin.tambah_prodi', [
            'jurusans' => Jurusan::all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validasi input
        $validatedData = $request->validate([
            'jurusan_id' => 'required', // Pastikan jurusan_id ada di tabel jurusans
            'name' => 'required|string|min:3|max:255',    // Nama Program Studi wajib diisi, minimal 3 karakter
        ]);

        // Simpan data ke dalam database
        Prodi::create([
            'jurusan_id' => $validatedData['jurusan_id'],
            'name' => $validatedData['name'],
        ]);

        // Redirect ke halaman lain dengan pesan sukses
        return redirect('/super_admin/data-prodi')->with('success', 'Data Program Studi berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        // Temukan prodi berdasarkan ID
        $prodi = Prodi::findOrFail($id);

        // Ambil semua data jurusan untuk dropdown
        $jurusans = Jurusan::all();

        // Tampilkan view edit dengan data prodi dan jurusan
        return view('super_admin.edit_prodi', compact('prodi', 'jurusans'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        // Validasi input
        $validatedData = $request->validate([
            'jurusan_id' => 'required', // Pastikan jurusan_id ada di tabel jurusans
            'name' => 'required|string|min:3|max:255',    // Nama Program Studi harus ada, minimal 3 karakter
        ]);

        // Temukan prodi berdasarkan ID
        $prodi = Prodi::findOrFail($id);

        // Update data prodi
        $prodi->update([
            'jurusan_id' => $validatedData['jurusan_id'], // Update jurusan yang dipilih
            'name' => $validatedData['name'], // Update nama prodi
        ]);

        // Redirect ke halaman index prodi dengan pesan sukses
        return redirect('/super_admin/data-prodi')->with('success', 'Data Program Studi berhasil diupdate.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        // Temukan prodi berdasarkan ID
        $prodi = Prodi::findOrFail($id);

        // Hapus prodi
        $prodi->delete();

        // Redirect dengan pesan sukses
        return redirect('/super_admin/data-prodi')->with('success', 'Data prodi berhasil dihapus.');
    }
}
