<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Jurusan;
use App\Models\Prodi;
use App\Models\Letter;
use App\Models\LetterType;
use App\Models\LeaveRequest;
use App\Models\LetterApproval;
use App\Models\LetterAttachment;

class DosenController extends Controller
{
    public function index()
    {
        // Dapatkan jurusan dosen yang sedang login
        $jurusanId = auth()->user()->jurusan_id;

        // Mengambil semua surat yang berkaitan dengan jurusan dosen
        $letters = Letter::whereHas('user', function ($query) use ($jurusanId) {
            $query->where('jurusan_id', $jurusanId);
        })->with('user', 'letterType')->get();

        return view('dosen.dashboard', compact('letters'));
    }

    public function show($id)
    {
        // Retrieve letter data with user, letterType, and attachments
        $letter = Letter::with(['user', 'letterType', 'user.prodi', 'attachments'])->findOrFail($id);
        // Check permissions as before
        $loggedDosen = auth()->user();
        if ($loggedDosen->id !== $letter->penerima_id && 
            !($loggedDosen->status == 2 && $loggedDosen->jurusan_id == $letter->user->jurusan_id)
        ) {
            abort(403, 'Akses tidak diizinkan.');
        }

        $parentSignature = $letter->attachments->first();
        $studentSignature = $letter->attachments->skip(1)->first();

        return view('dosen.detail_ajuan', compact('letter', 'parentSignature', 'studentSignature'));
    }

    public function approve(Letter $letter)
    {
        $loggedDosen = auth()->user();

        // Check if the logged-in dosen is either the recipient or a department head in the same department
        if (
            $loggedDosen->id !== $letter->penerima_id && 
            !($loggedDosen->status == 2 && $loggedDosen->jurusan_id == $letter->user->jurusan_id)
        ) {
            abort(403, 'Akses tidak diizinkan.');
        }

        // Update the letter's status in the letters table
        $letter->update([
            'status' => 'approved'
        ]);

        // Update the status in the leave_requests table if applicable
        $letter->leaveRequest()->update([
            'status' => 'approved'
        ]);

        // Add an entry to the letter_approvals table
        LetterApproval::create([
            'letter_id' => $letter->id,
            'approved_by' => $loggedDosen->id,
            'approval_status' => 'approved',
            'approval_notes' => 'Surat disetujui oleh pimpinan.',
        ]);

        return redirect('/dosen/dashboard')->with('success', 'Surat berhasil disetujui.');
    }

    public function reject(Letter $letter)
    {
        $loggedDosen = auth()->user();

        // Check if the logged-in dosen is either the recipient or a department head in the same department
        if (
            $loggedDosen->id !== $letter->penerima_id && 
            !($loggedDosen->status == 2 && $loggedDosen->jurusan_id == $letter->user->jurusan_id)
        ) {
            abort(403, 'Akses tidak diizinkan.');
        }

        // Update the letter's status in the letters table
        $letter->update([
            'status' => 'rejected'
        ]);

        // Update the status in the leave_requests table if applicable
        $letter->leaveRequest()->update([
            'status' => 'rejected'
        ]);

        // Add an entry to the letter_approvals table
        LetterApproval::create([
            'letter_id' => $letter->id,
            'approved_by' => $loggedDosen->id,
            'approval_status' => 'rejected',
            'approval_notes' => 'Surat ditolak oleh pimpinan.',
        ]);

        return redirect('/dosen/dashboard')->with('success', 'Surat berhasil ditolak.');
    }

    public function edit($username)
    {
        // Cari dosen berdasarkan username
        $dosen = User::where('username', $username)->firstOrFail();  // Menampilkan error 404 jika tidak ditemukan

        return view('dosen.edit_dosen', [
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

        return redirect()->route('dosen.edit', $dosen->username)->with('success', 'Data berhasil diupdate.');
    }
}
