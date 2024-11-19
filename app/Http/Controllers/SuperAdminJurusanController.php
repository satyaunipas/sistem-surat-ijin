<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Jurusan;
use App\Models\Prodi;

class SuperAdminJurusanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Retrieve all departments (jurusans) with related admin and prodi data
        $jurusans = Jurusan::with(['admin', 'prodi'])->get();

        return view('super_admin.data_admin_jurusan', compact('jurusans'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view ('super_admin.tambah_admin_jurusan', [
            'jurusans' => Jurusan::all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate input data
        $validatedData = $request->validate([
            'jurusan_id' => 'required|exists:jurusan,id',
            'name' => 'required|string|min:3|max:255',
            'username' => 'required|string|unique:users,username|max:255',
            'nomor_induk' => 'required|string|max:20',
            'alamat' => 'nullable|string|max:255',
            'phone_number' => 'nullable|string|max:20',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|confirmed|min:6',
        ]);

        // Create a new user with role 'admin'
        User::create([
            'jurusan_id' => $validatedData['jurusan_id'],
            'name' => $validatedData['name'],
            'username' => $validatedData['username'],
            'nomor_induk' => $validatedData['nomor_induk'],
            'alamat' => $validatedData['alamat'] ?? null,
            'phone_number' => $validatedData['phone_number'] ?? null,
            'email' => $validatedData['email'],
            'password' => bcrypt($validatedData['password']), // Hash the password
            'role' => 'admin',
        ]);

        // Redirect ke halaman lain dengan pesan sukses
        return redirect('/super_admin/admin-jurusan')->with('success', 'Data Admin berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show($username)
    {
        // Fetch the user with the role of 'admin' and the specified username
        $admin = User::where('username', $username)
                    ->where('role', 'admin')
                    ->with('jurusan') // Ensure the jurusan data is loaded
                    ->firstOrFail(); // Throws 404 if not found

        // Pass the admin data to the view
        return view('super_admin.detail_admin_jurusan', compact('admin'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($username)
    {
        // Find the admin based on username
        $admin = User::where('username', $username)
                    ->where('role', 'admin')
                    ->with('jurusan') // Load related jurusan data
                    ->firstOrFail();

        // Retrieve all jurusan data for the dropdown selection
        $jurusans = Jurusan::all();

        // Pass admin and jurusans data to the view
        return view('super_admin.edit_admin_jurusan', compact('admin', 'jurusans'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $username)
    {
        // Validate the form data
        $validatedData = $request->validate([
            'name' => 'required|string|min:3|max:255',
            'username' => 'required|string|min:3|max:255|unique:users,username,' . $username . ',username', // Unique except for current user
            'nomor_induk' => 'required|string|max:20',
            'alamat' => 'nullable|string|max:255',
            'phone_number' => 'nullable|string|max:15',
            'email' => 'required|email|unique:users,email,' . $username . ',username', // Unique except for current user
            'jurusan_id' => 'required|exists:jurusan,id',
            'password' => 'nullable|string|confirmed|min:6', // Password is optional, only if user wants to update
        ]);

        // Find the admin by username
        $admin = User::where('username', $username)->firstOrFail();

        // Update basic data
        $admin->update([
            'name' => $validatedData['name'],
            'username' => $validatedData['username'],
            'nomor_induk' => $validatedData['nomor_induk'],
            'alamat' => $validatedData['alamat'],
            'phone_number' => $validatedData['phone_number'],
            'email' => $validatedData['email'],
            'jurusan_id' => $validatedData['jurusan_id'],
        ]);

        // Update password if provided
        if ($request->filled('password')) {
            $admin->update(['password' => Hash::make($validatedData['password'])]);
        }

        // Redirect back with a success message
        return redirect()->route('super_admin.admin-jurusan.index')->with('success', 'Data Admin berhasil diupdate.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($username)
    {
        // Find the user by username
        $adminJurusan = User::where('username', $username)->first();

        // Check if the user exists
        if (!$adminJurusan) {
            return redirect()->route('super_admin.admin-jurusan.index')->with('error', 'Data Admin Jurusan tidak ditemukan.');
        }

        // Delete the user
        $adminJurusan->delete();

        // Redirect with a success message
        return redirect()->route('super_admin.admin-jurusan.index')->with('success', 'Data Admin Jurusan berhasil dihapus.');
    }
}
