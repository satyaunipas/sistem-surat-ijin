<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Jurusan;
use App\Models\Prodi;
use App\Models\Letter;
use App\Models\LetterType;
use App\Models\LeaveRequest;
use App\Models\LetterAttachment;

class MahasiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Mengambil data surat yang diajukan oleh mahasiswa yang sedang login
        $letters = Letter::where('user_id', auth()->user()->id)->get();

        return view('mahasiswa.dashboard', compact('letters'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Ambil data mahasiswa yang sedang login beserta program studinya
        $mahasiswa = User::with('prodi')->findOrFail(auth()->id());

        // Ambil dosen berdasarkan jurusan yang sama dengan mahasiswa
        $dosens = User::where('jurusan_id', $mahasiswa->jurusan_id)
                    ->where('role', 'dosen')
                    ->with('jurusan')  // Eager loading untuk menghindari N+1
                    ->get();

        // Ambil data jenis surat dari tabel letter_types
        $letterTypes = LetterType::all();

        // Arahkan ke view mahasiswa.tambah_surat dengan data letterTypes
        return view('mahasiswa.tambah_surat', compact('mahasiswa', 'dosens', 'letterTypes'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validasi data form
        $request->validate([
            'penerima' => 'required',
            'tempat_surat' => 'required',
            'request_date' => 'required|date',
            'leave_date' => 'required|date',
            'alasan_izin' => 'required',
            'nama_ortu' => 'required',
            'ttd_ortu' => 'required|image|mimes:png,jpg,jpeg|max:2048', // max 2MB, accepts png, jpg, jpeg
            'ttd_mhs' => 'required|image|mimes:png,jpg,jpeg|max:2048'
        ]);

        $ttdOrtuPath = $request->file('ttd_ortu')->store('signatures', 'public');
        $ttdMhsPath = $request->file('ttd_mhs')->store('signatures', 'public');

        // Simpan data ke tabel letters
        $letter = Letter::create([
            'user_id' => auth()->id(),
            'penerima_id' => $request->input('penerima'),
            'letter_type_id' => $request->input('alasan_izin'), // Ambil jenis surat dari request
            'request_date' => $request->input('request_date'),
            'status' => 'pending',
            'tempat_surat' => $request->input('tempat_surat')
        ]);

        // Simpan ke tabel leave_requests untuk surat izin
        LeaveRequest::create([
            'user_id' => auth()->id(),
            'letter_id' => $letter->id,
            'leave_date' => $request->input('leave_date'),
            'leave_type' => $letter->letter_type_id, // Tipe izin
            'tempat_surat' => $request->input('tempat_surat'),
            'status' => 'pending',
            'nama_ortu' => $request->input('nama_ortu')
        ]);

        // Save the signature files to the letter_attachments table
        LetterAttachment::create([
            'letter_id' => $letter->id,
            'file_path' => $ttdOrtuPath
        ]);

        LetterAttachment::create([
            'letter_id' => $letter->id,
            'file_path' => $ttdMhsPath
        ]);

        return redirect()->route('mahasiswa.dashboard')->with('success', 'Surat berhasil diajukan');
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
    public function edit($username)
    {
        // Cari mahasiswa berdasarkan username
        $mahasiswa = User::where('username', $username)->firstOrFail();  // Menampilkan error 404 jika tidak ditemukan

        return view('mahasiswa.edit_mahasiswa', [
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

        return redirect()->route('mahasiswa.edit', $mahasiswa->username)->with('success', 'Data mahasiswa berhasil diupdate.');
    }

    public function editSurat($id)
    {
        // Cari surat berdasarkan id
        $letter = Letter::with('leaveRequest')->findOrFail($id);
        $mahasiswa = auth()->user(); // Ambil data mahasiswa yang login

        // Ambil dosen dan jenis surat
        $dosens = User::where('role', 'dosen')->get();
        $letterTypes = LetterType::all();

        return view('mahasiswa.edit_surat', compact('letter', 'dosens', 'letterTypes'));
    }

    public function updateSurat(Request $request, $id)
    {
        // Validasi input tanpa wajib file tanda tangan
        $validatedData = $request->validate([
            'penerima' => 'required',
            'tempat_surat' => 'required',
            'request_date' => 'required|date',
            'leave_date' => 'required|date',
            'alasan_izin' => 'required',
            'nama_ortu' => 'required',
            'ttd_ortu' => 'nullable|image|mimes:png,jpg,jpeg|max:2048', // nullable untuk tidak wajib
            'ttd_mhs' => 'nullable|image|mimes:png,jpg,jpeg|max:2048'
        ]);

        // Cari surat berdasarkan id
        $letter = Letter::findOrFail($id);
        $leaveRequest = $letter->leaveRequest; // Ambil leaveRequest terkait surat

        // Update surat
        $letter->update([
            'penerima_id' => $validatedData['penerima'],
            'tempat_surat' => $validatedData['tempat_surat'],
            'request_date' => $validatedData['request_date'],
            'letter_type_id' => $validatedData['alasan_izin'],
        ]);

        // Update leave request
        $leaveRequest->update([
            'leave_date' => $validatedData['leave_date'],
            'nama_ortu' => $validatedData['nama_ortu']
        ]);

        // Ambil semua attachment terkait surat
        $attachments = $letter->attachments()->get();

        // Update tanda tangan ortu jika ada file baru
        if ($request->hasFile('ttd_ortu')) {
            $ttdOrtuPath = $request->file('ttd_ortu')->store('signatures', 'public');

            if ($attachments->count() > 0) {
                // Jika ada, update tanda tangan ortu (attachment pertama)
                $attachments[0]->update(['file_path' => $ttdOrtuPath]);
            } else {
                // Jika tidak ada, tambahkan tanda tangan ortu sebagai attachment pertama
                $letter->attachments()->create(['file_path' => $ttdOrtuPath]);
            }
        }

        // Update tanda tangan mahasiswa jika ada file baru
        if ($request->hasFile('ttd_mhs')) {
            $ttdMhsPath = $request->file('ttd_mhs')->store('signatures', 'public');

            if ($attachments->count() > 1) {
                // Jika ada, update tanda tangan mahasiswa (attachment kedua)
                $attachments[1]->update(['file_path' => $ttdMhsPath]);
            } else {
                // Jika tidak ada, tambahkan tanda tangan mahasiswa sebagai attachment kedua
                $letter->attachments()->create(['file_path' => $ttdMhsPath]);
            }
        }

        return redirect()->route('mahasiswa.dashboard')->with('success', 'Surat berhasil diupdate.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // Cari surat berdasarkan ID
        $letter = Letter::findOrFail($id);
        
        // Hapus data terkait di tabel leave_requests jika ada relasi
        if ($letter->leaveRequest) {
            $letter->leaveRequest->delete();
        }

        // Hapus surat dari tabel letters
        $letter->delete();

        // Redirect kembali ke halaman dengan pesan sukses
        return redirect()->route('mahasiswa.dashboard')->with('success', 'Surat berhasil dihapus.');
    }
}
