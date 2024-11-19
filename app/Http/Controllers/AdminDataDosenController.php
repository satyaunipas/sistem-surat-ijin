<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Jurusan;
use App\Models\Prodi;

class AdminDataDosenController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $adminJurusanId = auth()->user()->jurusan_id; // Ambil jurusan admin yang sedang login
        $dosens = User::where('role', 'dosen')
                  ->where('jurusan_id', $adminJurusanId) // Filter dosen berdasarkan jurusan admin
                  ->get();
        return view('admin.data_dosen', compact('dosens'));
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

        return view('admin.tambah_dosen', compact('jurusans', 'prodis'));
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
        $validatedData['role'] = 'dosen'; // Menetapkan role sebagai dosen
        $validatedData['status'] = 2; // Menetapkan status ke 2 (bukan pimpinan)
        $validatedData['password'] = Hash::make($validatedData['password']); // Enkripsi password

        User::create($validatedData);

        return redirect('/admin/data-dosen')->with('success', 'Tambah data dosen berhasil!');
    }

    /**
     * Display the specified resource.
     */
    public function show($username)
    {
        $dosen = User::where('username', $username)->first();  // Ambil dosen berdasarkan username
        if (!$dosen) {
            abort(404);  // Jika data tidak ditemukan, tampilkan halaman 404
        }
        return view('admin.detail_dosen', compact('dosen'));
    }
    
    /**
     * Show the form for editing the specified resource.
     */
    public function edit($username)
    {
        // Cari dosen berdasarkan username
        $dosen = User::where('username', $username)->firstOrFail();  // Menampilkan error 404 jika tidak ditemukan

        return view('admin.edit_dosen', [
            'jurusans' => Jurusan::all(),
            'prodis' => Prodi::all(),
            'dosen' => $dosen,  // Mengirim data dosen
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $username)
    {
        // Cari dosen berdasarkan username
        $dosen = User::where('username', $username)->firstOrFail();  // Menampilkan error 404 jika tidak ditemukan
        $rules = [
            'name'=>['required', 'min:3', 'max:255'],
            'alamat'=>'required',
            'phone_number'=>'required',
            'jurusan_id'=>'required',
            'program_study_id'=>'required'
        ];

        // Validasi unik untuk 'username' jika ada perubahan
        if ($request->username != $dosen->username) {
            $rules['username'] = ['required', 'min:3', 'max:255', 'unique:users,username,' . $dosen->id];
        }

        // Validasi unik untuk 'nomor_induk' jika ada perubahan
        if ($request->nomor_induk != $dosen->nomor_induk) {
            $rules['nomor_induk'] = ['required', 'unique:users,nomor_induk,' . $dosen->id];
        }

        // Validasi unik untuk 'email' jika ada perubahan
        if ($request->email != $dosen->email) {
            $rules['email'] = ['required', 'email', 'unique:users,email,' . $dosen->id];
        }

        // Validasi request berdasarkan aturan
        $validatedData = $request->validate($rules);

        // Jika password diisi, maka update password
        if ($request->filled('password')) {
            $validatedData['password'] = bcrypt($request->password);
        }

        // Update data dosen
        $dosen->update($validatedData);

        return redirect('/admin/data-dosen')->with('success', 'Data dosen berhasil diupdate.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($username)
    {
        $dosen = User::where('username', $username)->first();  // Ambil dosen berdasarkan username
        User::destroy($dosen->id);

        return redirect('/admin/data-dosen')->with('success', 'Berhasil menghapus data dosen!');
    }

    public function updateStatus(Request $request, $id)
    {
        // Validasi request untuk memastikan bahwa status dikirim
        $request->validate([
            'status' => 'required|in:1,2'
        ]);

        // Temukan dosen berdasarkan ID
        $dosen = User::where('id', $id)->where('role', 'dosen')->firstOrFail();

        // Update status dosen
        $dosen->status = $request->input('status');
        $dosen->save();

        // Berikan respons JSON untuk mengonfirmasi pembaruan berhasil
        return response()->json(['success' => true, 'message' => 'Status dosen berhasil diperbarui']);
    }
}
