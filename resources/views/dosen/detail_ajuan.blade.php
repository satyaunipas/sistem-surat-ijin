@extends('dashboard')

@section('content')
<!-- Page Content -->
<div class="content">
    <!-- Detail Section -->
    <div class="block block-rounded">
        <div class="block-header block-header-default">
            <h3 class="block-title">Detail Surat</h3>
            <!-- Approval Buttons -->
            <div style="text-align:right;">
                @if($letter->status == 'pending')
                    <form id="approve-form-{{ $letter->id }}" action="{{ route('dosen.dashboard.approve', $letter->id) }}" method="POST" style="display:inline;">
                        @csrf
                        <button type="button" class="btn btn-alt-success btn-sm" onclick="if (confirm('Apakah Anda yakin ingin menyetujui surat ini?')) { document.getElementById('approve-form-{{ $letter->id }}').submit(); }">
                            <i class="fas fa-check-circle"></i> Approve
                        </button>
                    </form>
                    <form id="reject-form-{{ $letter->id }}" action="{{ route('dosen.dashboard.reject', $letter->id) }}" method="POST" style="display:inline;">
                        @csrf
                        <button type="button" class="btn btn-alt-danger btn-sm" onclick="if (confirm('Apakah Anda yakin ingin menolak surat ini?')) { document.getElementById('reject-form-{{ $letter->id }}').submit(); }">
                            <i class="fas fa-times-circle"></i> Reject
                        </button>
                    </form>
                @elseif($letter->status == 'approved')
                    <span class="btn btn-success btn-sm disabled"><i class="fas fa-check-circle"></i> Approved</span>
                @elseif($letter->status == 'rejected')
                    <span class="btn btn-danger btn-sm disabled"><i class="fas fa-times-circle"></i> Rejected</span>
                @endif
            </div>
        </div>

        <div class="block-content" id="surat-preview">
            <!-- Kop Surat -->
            <div class="kop-surat" style="text-align:center;">
                <div style="display: flex; align-items: center; justify-content: center;">
                    <div style="flex: 0;">
                        <img src="{{ asset('media/photos/logopnb.png') }}" alt="Logo Politeknik" style="width: 100px; margin-right: 10px;">
                    </div>
                    <div style="flex: 1;">
                        <h4>KEMENTERIAN PENDIDIKAN DAN KEBUDAYAAN</h4>
                        <h3>POLITEKNIK NEGERI BALI</h3>
                        <p>Jalan Kampus Bukit Jimbaran, Kuta Selatan, Kabupaten Badung, Bali - 80364</p>
                        <p>Telp. (0361) 701981 Fax. 701128, Laman: www.pnb.ac.id, Email: poltek@pnb.ac.id</p>
                    </div>
                </div>
            </div>

            <!-- Surat Details -->
            <div style="text-align:right; margin-bottom: 10px; margin-top: 20px;">
                {{ $letter->tempat_surat }}, {{ \Carbon\Carbon::parse($letter->request_date)->format('d-m-Y') }}
            </div>

            <p>Kepada Yth, <br><span class="fw-bold">{{ $letter->penerima->name }}</span><br>Di Tempat</p>
            <p>Dengan Hormat, Saya yang bertanda tangan di bawah ini:</p>
            <p>Nama : <span class="fw-bold">{{ $letter->user->name }}</span></p>
            <p>NIM : <span class="fw-bold">{{ $letter->user->nomor_induk }}</span></p>
            <p>Program Studi : <span class="fw-bold">{{ optional($letter->user->prodi)->name }}</span></p>

            <p>Dengan ini saya mengajukan permohonan izin tidak masuk kuliah pada tanggal 
                <span class="fw-bold">{{ \Carbon\Carbon::parse($letter->leaveRequest->leave_date)->format('d-m-Y') }}</span> dikarenakan 
                <span class="fw-bold">{{ $letter->letterType->name }}</span>.
            </p>
            <p>Demikian surat ini saya sampaikan, atas perhatiannya saya ucapkan terima kasih.</p>

            <!-- Tanda Tangan -->
            <div style="display: flex; justify-content: space-between; margin-top: 40px;">
                <!-- Parent Signature on the left -->
                <div style="text-align:left;">
                    Orang Tua/Wali,
                    <div style="margin-top: 10px;">
                        @if($parentSignature)
                            <img src="{{ asset('storage/' . $parentSignature->file_path) }}" alt="TTD Orang Tua" style="width: 100px; display: block; margin-bottom: 10px;">
                        @else
                            <p style="color: red;">Tanda tangan orang tua tidak ditemukan</p>
                        @endif
                        <span class="fw-bold">{{ $letter->leaveRequest->nama_ortu }}</span>
                    </div>
                </div>

                <!-- Student Signature on the right -->
                <div style="text-align:right;">
                    Hormat Saya,
                    <div style="margin-top: 10px;">
                        @if($studentSignature)
                            <img src="{{ asset('storage/' . $studentSignature->file_path) }}" alt="TTD Mahasiswa" style="width: 100px; display: block; margin-bottom: 10px;">
                        @else
                            <p style="color: red;">Tanda tangan mahasiswa tidak ditemukan</p>
                        @endif
                        <span class="fw-bold">{{ $letter->user->name }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- END Page Content -->
@endsection