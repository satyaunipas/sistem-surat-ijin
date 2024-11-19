@extends('dashboard')

@section('content')
<!-- Page Content -->
<div class="content">
  <!-- Block for Surat Izin -->
  <div class="row">
    <!-- Form input pengajuan surat -->
    <div class="col-md-4">
      <div class="block block-rounded">
        <div class="block-header block-header-default">
          <h3 class="block-title">Form Pengajuan</h3>
        </div>
        <div class="block-content">
          <!-- Form for Surat Izin -->
          <form action="{{ route('mahasiswa.surat.update', $letter->id) }}" method="post" enctype="multipart/form-data">
            @method('PUT')
            @csrf
              <!-- Penerima Surat -->
              <div class="form-group" style="margin-bottom: 15px;">
                  <label for="penerima">Penerima Surat (Dosen Mata Kuliah) <span class="text-danger">*</span></label>
                    <select class="form-control" id="penerima" name="penerima" required onchange="updatePreview()">
                      <option value="" disabled {{ old('penerima', $letter->penerima_id) == '' ? 'selected' : '' }}>Pilih Dosen</option>
                      @foreach ($dosens as $dosen)
                          <option value="{{ $dosen->id }}" {{ old('penerima', $letter->penerima_id) == $dosen->id ? 'selected' : '' }}>{{ $dosen->name }}</option>
                      @endforeach
                  </select>
              </div>
      
              <!-- Tempat dan Tanggal Surat -->
              <div class="form-group" style="margin-bottom: 15px;">
                  <label for="tempat_surat">Tempat Surat <span class="text-danger">*</span></label>
                  <input type="text" class="form-control" id="tempat_surat" name="tempat_surat" value="{{ old('tempat_surat', $letter->tempat_surat) }}" required oninput="updatePreview()">
              </div>
      
              <div class="form-group" style="margin-bottom: 15px;">
                  <label for="request_date">Tanggal Surat <span class="text-danger">*</span></label>
                  <input type="date" class="form-control" id="request_date" name="request_date" value="{{ old('request_date', $letter->request_date) }}" required oninput="updatePreview()">
              </div>
      
              <!-- Tanggal Mulai dan Selesai Izin -->
              <div class="form-group" style="margin-bottom: 15px;">
                  <label for="leave_date">Tanggal Izin <span class="text-danger">*</span></label>
                  <input type="date" class="form-control" id="leave_date" name="leave_date" value="{{ old('leave_date', $letter->leaveRequest->leave_date) }}" required oninput="updatePreview()">
              </div>
      
              <!-- Alasan Pengajuan -->
              <div class="form-group" style="margin-bottom: 15px;">
                  <label for="alasan_izin">Alasan Izin <span class="text-danger">*</span></label>
                    <select class="form-control" id="alasan_izin" name="alasan_izin" required onchange="updatePreview()">
                      <option value="" disabled {{ old('alasan_izin', $letter->letter_type_id) == '' ? 'selected' : '' }}>Pilih Alasan Izin</option>
                      @foreach ($letterTypes as $letterType)
                          <option value="{{ $letterType->id }}" {{ old('alasan_izin', $letter->letter_type_id) == $letterType->id ? 'selected' : '' }}>{{ $letterType->name }}</option>
                      @endforeach
                  </select>
              </div>

              <div class="form-group" style="margin-bottom: 15px;">
                <label for="nama_ortu">Nama Ortu <span class="text-danger">*</span></label>
                <input type="text" class="form-control" id="nama_ortu" name="nama_ortu" value="{{ old('nama_ortu', $letter->leaveRequest->nama_ortu) }}" required oninput="updatePreview()">
              </div>

              <!-- Attachment Upload for Parent Signature -->
              <div class="form-group" style="margin-bottom: 15px;">
                <label for="ttd_ortu">TTD Orang Tua</label>
                <input type="file" class="form-control-file" id="ttd_ortu" name="ttd_ortu" onchange="updatePreview()">
              </div>

              <!-- Attachment Upload for Student Signature -->
              <div class="form-group" style="margin-bottom: 15px;">
                <label for="ttd_mhs">TTD Mahasiswa</label>
                <input type="file" class="form-control-file" id="ttd_mhs" name="ttd_mhs" onchange="updatePreview()">
              </div>
      
              <!-- Submit Button -->
              <div class="form-group" style="margin-bottom: 15px;">
                <button type="submit" class="btn btn-primary"><i class="fas fa-paper-plane"></i> Edit Pengajuan</button>
              </div>
          </form>
      </div>
      </div>
    </div>

    <!-- Preview Section -->
    <div class="col-md-8">
      <div class="block block-rounded">
          <div class="block-header block-header-default">
              <h3 class="block-title">Preview Surat</h3>
          </div>
          <div class="block-content" id="surat-preview">
              <!-- Kop Surat -->
              <div class="kop-surat" style="text-align:center;">
                  <div style="display: flex; align-items: center; justify-content: center;">
                      <!-- Logo -->
                      <div style="flex: 0;">
                          <img src="{{ asset('media/photos/logopnb.png') }}" alt="Logo Politeknik" style="width: 100px; margin-right: 10px;">
                      </div>
                      <!-- Teks Kop -->
                      <div style="flex: 1;">
                          <h4 style="font-size: 16px; margin: 0;">KEMENTERIAN PENDIDIKAN DAN KEBUDAYAAN</h4>
                          <h3 style="font-size: 20px; margin: 0;">POLITEKNIK NEGERI BALI</h3>
                          <p style="font-size: 14px; margin: 0;">Jalan Kampus Bukit Jimbaran, Kuta Selatan, Badung, Bali - 80364</p>
                          <p style="font-size: 14px; margin: 0;">Telp. (0361) 701981 Fax. 701128, Laman: www.pnb.ac.id, Email: poltek@pnb.ac.id</p>
                      </div>
                  </div>
              </div>

              <!-- Tempat dan Tanggal Surat -->
              <div style="text-align:right; margin-bottom: 10px; margin-top: 20px;">
                  <span id="preview-tempat">{{ $letter->tempat_surat }}</span>, <span id="preview-tanggal-surat">{{ \Carbon\Carbon::parse($letter->request_date)->format('d-m-Y') }}</span>
              </div>

              <!-- Penerima dan Isi Surat -->
              <p style="margin-bottom: 20px;">
                  Kepada Yth, <br><span id="preview-penerima" class="fw-bold">{{ $letter->penerima->name }}</span><br>
                  Di Tempat
              </p>

              <p style="margin-bottom: 10px;">
                  Dengan Hormat, Saya yang bertanda tangan di bawah ini:
                  <span style="display: block; margin-top: 10px;">Nama : <span id="preview-nama" class="fw-bold">{{ $letter->user->name }}</span></span>
                  <span style="display: block;">NIM : <span id="preview-nim" class="fw-bold">{{ $letter->user->nomor_induk }}</span></span>
                  <span>Program Studi : <span id="preview-program_studi" class="fw-bold">{{ optional($letter->user->prodi)->name }}</span></span>
              </p>

              <p style="margin-bottom: 20px;">
                  Dengan ini saya mengajukan permohonan izin tidak masuk kuliah pada tanggal 
                  <span id="preview-tanggal-mulai" class="fw-bold">{{ \Carbon\Carbon::parse($letter->leaveRequest->leave_date)->format('d-m-Y') }}</span>, 
                  dikarenakan <span id="preview-alasan" class="fw-bold">{{ $letter->letterType->name }}</span>.
              </p>

              <p style="margin-bottom: 20px;">
                  Demikian surat ini saya sampaikan, atas perhatiannya saya ucapkan terima kasih.
              </p>
              <!-- Tanda Tangan di atas Nama -->
              <div style="display: flex; justify-content: space-between; margin-top: 40px;">
                <!-- Nama dan Tanda Tangan Orang Tua di sebelah kiri -->
                <div style="text-align:left;">
                    <div>Orang Tua/Wali,</div>
                    <div style="margin-top: 10px;">
                        <img id="preview-ttd-ortu" src="{{ asset('storage/' . ($letter->attachments->first() ? $letter->attachments->first()->file_path : '')) }}" 
                            alt="Tanda Tangan Orang Tua" style="width: 100px; display: {{ $letter->attachments->first() ? 'block' : 'none' }};">
                        <span id="preview-nama-ortu" class="fw-bold">{{ $letter->leaveRequest->nama_ortu }}</span>
                    </div>
                </div>

                <!-- Hormat Saya di sebelah kanan -->
                <div style="text-align:right;">
                    Hormat Saya,
                    <div style="margin-top: 10px;">
                        <img id="preview-ttd-mhs" src="{{ asset('storage/' . ($letter->attachments->last() ? $letter->attachments->last()->file_path : '')) }}" 
                            alt="Tanda Tangan Mahasiswa" style="width: 100px; display: {{ $letter->attachments->last() ? 'block' : 'none' }};">
                    </div>
                    <div style="margin-bottom: 10px;">
                        <span id="preview-ttd-nama" class="fw-bold">{{ $letter->user->name }}</span>
                    </div>
                </div>
              </div>
          </div>
      </div>
    </div>
  </div>
</div>
<!-- END Page Content -->

<script>
  function updatePreview() {
      // Mengambil nilai dari input lainnya
      let penerima = document.getElementById('penerima').options[document.getElementById('penerima').selectedIndex].text;
      let tempatSurat = document.getElementById('tempat_surat').value;
      let tanggalSurat = document.getElementById('request_date').value;
      let tanggalMulai = document.getElementById('leave_date').value;
      let alasanIzin = document.getElementById('alasan_izin').options[document.getElementById('alasan_izin').selectedIndex].text;
      let namaOrtu = document.getElementById('nama_ortu').value;

      // Format tanggal dari yyyy-mm-dd ke dd-mm-yyyy
      function formatTanggal(tanggal) {
          if (tanggal) {
              let parts = tanggal.split("-");
              return `${parts[2]}-${parts[1]}-${parts[0]}`;
          }
          return "[Tanggal Tidak Valid]";
      }

      // Update preview text fields
      document.getElementById('preview-penerima').textContent = penerima || '[Penerima Surat]';
      document.getElementById('preview-tempat').textContent = tempatSurat || '[Tempat Surat]';
      document.getElementById('preview-tanggal-surat').textContent = formatTanggal(tanggalSurat) || '[Tanggal Surat]';
      document.getElementById('preview-tanggal-mulai').textContent = formatTanggal(tanggalMulai) || '[Tanggal Mulai Izin]';
      document.getElementById('preview-alasan').textContent = alasanIzin || '[Alasan Izin]';
      document.getElementById('preview-nama-ortu').textContent = namaOrtu || '[Nama Orang Tua]';

      // Pratinjau tanda tangan orang tua
      const ttdOrtuInput = document.getElementById('ttd_ortu');
      const previewTtdOrtu = document.getElementById('preview-ttd-ortu');
      if (ttdOrtuInput.files && ttdOrtuInput.files[0]) {
          const readerOrtu = new FileReader();
          readerOrtu.onload = function(e) {
              previewTtdOrtu.src = e.target.result;
              previewTtdOrtu.style.display = 'block';
          };
          readerOrtu.readAsDataURL(ttdOrtuInput.files[0]);
      }

      // Pratinjau tanda tangan mahasiswa
      const ttdMhsInput = document.getElementById('ttd_mhs');
      const previewTtdMhs = document.getElementById('preview-ttd-mhs');
      if (ttdMhsInput.files && ttdMhsInput.files[0]) {
          const readerMhs = new FileReader();
          readerMhs.onload = function(e) {
              previewTtdMhs.src = e.target.result;
              previewTtdMhs.style.display = 'block';
          };
          readerMhs.readAsDataURL(ttdMhsInput.files[0]);
      }
  }
</script>
@endsection