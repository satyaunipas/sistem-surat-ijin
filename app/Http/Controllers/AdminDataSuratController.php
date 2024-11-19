<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Jurusan;
use App\Models\Prodi;
use App\Models\LeaveRequest;
use App\Models\Letter;
use App\Models\LetterApproval;

class AdminDataSuratController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $jurusanId = auth()->user()->jurusan_id; // Mendapatkan jurusan admin yang sedang login

        // Mengambil surat terkait jurusan tertentu dan melibatkan relasi yang relevan
        $surats = Letter::with(['user', 'letterType', 'leaveRequest', 'approvals'])
            ->whereHas('user', function($query) use ($jurusanId) {
                $query->where('jurusan_id', $jurusanId);
            })
            ->get();

        return view('admin.data_surat', compact('surats'));
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Ambil jurusan berdasarkan jurusan admin yang sedang login
        $adminJurusanId = auth()->user()->jurusan_id;
        $jurusans = Jurusan::where('id', $adminJurusanId)->get();

        return view('admin.tambah_prodi', compact('jurusans'));
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
        return redirect('/admin/data-prodi')->with('success', 'Data Program Studi berhasil ditambahkan.');
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
        return view('admin.edit_prodi', compact('prodi', 'jurusans'));
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
        return redirect('/admin/data-prodi')->with('success', 'Data Program Studi berhasil diupdate.');
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
        return redirect('/admin/data-prodi')->with('success', 'Data prodi berhasil dihapus.');
    }
}
