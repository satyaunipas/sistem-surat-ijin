<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Jurusan;
use App\Models\Prodi;

class AdminDataJurusanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.data_jurusan', [
            'jurusans' => Jurusan::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view ('admin.tambah_jurusan', [
            'jurusans' => Jurusan::all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name'=>['required', 'min:1', 'max:255']
        ]);
        Jurusan::create($validatedData);

        return redirect('/admin/data-jurusan')->with('success', 'Tambah data jurusan berhasil!');
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
        // Temukan jurusan berdasarkan ID
        $jurusan = Jurusan::findOrFail($id);

        // Tampilkan view edit dengan data jurusan
        return view('admin.edit_jurusan', compact('jurusan'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        // Validasi input
        $validatedData = $request->validate([
            'name' => 'required|min:3|max:255',
        ]);

        // Temukan jurusan berdasarkan ID
        $jurusan = Jurusan::findOrFail($id);

        // Update data jurusan
        $jurusan->update([
            'name' => $validatedData['name'],
        ]);

        // Redirect dengan pesan sukses
        return redirect('/admin/data-jurusan')->with('success', 'Data jurusan berhasil diupdate.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        // Temukan jurusan berdasarkan ID
        $jurusan = Jurusan::findOrFail($id);

        // Hapus jurusan
        $jurusan->delete();

        // Redirect dengan pesan sukses
        return redirect('/admin/data-jurusan')->with('success', 'Data jurusan berhasil dihapus.');
    }
}
