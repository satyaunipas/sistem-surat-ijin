@extends('dashboard')

@section('css')
  <!-- Page JS Plugins CSS -->
  <link rel="stylesheet" href="{{ asset('js/plugins/datatables-bs5/css/dataTables.bootstrap5.min.css') }}">
  <link rel="stylesheet" href="{{ asset('js/plugins/datatables-buttons-bs5/css/buttons.bootstrap5.min.css') }}">
@endsection

@section('js')
  <!-- jQuery (required for DataTables plugin) -->
  <script src="{{ asset('js/lib/jquery.min.js') }}"></script>

  <!-- Page JS Plugins -->
  <script src="{{ asset('js/plugins/datatables/jquery.dataTables.min.js') }}"></script>
  <script src="{{ asset('js/plugins/datatables-bs5/js/dataTables.bootstrap5.min.js') }}"></script>
  <script src="{{ asset('js/plugins/datatables-buttons/dataTables.buttons.min.js') }}"></script>
  <script src="{{ asset('js/plugins/datatables-buttons-bs5/js/buttons.bootstrap5.min.js') }}"></script>
  <script src="{{ asset('js/plugins/datatables-buttons-jszip/jszip.min.js') }}"></script>
  <script src="{{ asset('js/plugins/datatables-buttons-pdfmake/pdfmake.min.js') }}"></script>
  <script src="{{ asset('js/plugins/datatables-buttons-pdfmake/vfs_fonts.js') }}"></script>
  <script src="{{ asset('js/plugins/datatables-buttons/buttons.print.min.js') }}"></script>
  <script src="{{ asset('js/plugins/datatables-buttons/buttons.html5.min.js') }}"></script>

  <!-- Page JS Code -->
  @vite(['resources/js/pages/datatables.js'])
@endsection

@section('content')

  <!-- Page Content -->
  <div class="content">

    <!-- Dynamic Table with Export Buttons -->
    <div class="block block-rounded">
      <div class="block-header block-header-default">
        <h3 class="block-title">
          Data Pengajuan Surat
        </h3>
      </div>
      <div class="block-content block-content-full">
        @if(session()->has('success'))
                      <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <strong>{{ session('success') }}</strong>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                      </div>
                      @endif
        <a href="/mahasiswa/dashboard/create" class="btn btn-alt-primary mb-3">Tambah Pengajuan Surat</a>

         <!-- Cek apakah ada surat yang diajukan -->
         @if($letters->isEmpty())
         <!-- Jika tidak ada surat, tampilkan pesan -->
          <div class="text-center">
              <h2>Anda belum pernah mengajukan surat</h2>
          </div> 
         @else
        <!-- DataTables init on table by adding .js-dataTable-buttons class, functionality is initialized in js/pages/tables_datatables.js -->
        <table class="table table-bordered table-striped table-vcenter js-dataTable-buttons fs-sm">
          <thead>
            <tr>
              <th class="text-center">No</th>
              <th>Surat</th>
              <th>Diajukan ke</th>
              <th>Pengajuan</th>
              <th>Tanggal Ijin</th>
              <th>Status</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
              @foreach ($letters as $letter)
              <tr>
                <td class="text-center">{{ $loop->iteration }}</td>
                <td class="fw-semibold">{{ $letter->letterType->name }}
                </td>
                <td class="fw-semibold">{{ $letter->penerima->name }}
                </td>
                <td>
                  {{ \Carbon\Carbon::parse($letter->request_date)->format('d-m-Y') }}
                </td>
                <td>
                  @if ($letter->leaveRequest)
                      {{ \Carbon\Carbon::parse($letter->leaveRequest->leave_date)->format('d-m-Y') }}
                  @else
                      -
                  @endif
                </td>
                <td>
                    @if($letter->status == 'pending')
                        <span class="badge rounded-pill bg-warning">
                            <i class="fas fa-exclamation-circle"></i> {{ $letter->status }}
                        </span>
                    @elseif($letter->status == 'approved')
                        <span class="badge rounded-pill bg-success">
                            <i class="fas fa-check-circle"></i> {{ $letter->status }}
                        </span>
                    @elseif($letter->status == 'rejected')
                        <span class="badge rounded-pill bg-danger">
                            <i class="fas fa-times-circle"></i> {{ $letter->status }}
                        </span>
                    @endif
                </td>
                <td>
                    @if($letter->status == 'pending')
                        <!-- Tombol Edit hanya muncul jika status pending -->
                        <a href="/mahasiswa/dashboard/{{ $letter->id }}/edit" class="btn btn-alt-success btn-sm">
                            <i class="fas fa-edit"></i> Edit
                        </a>
                
                        <!-- Tombol Hapus hanya muncul jika status pending -->
                        <form action="{{ route('mahasiswa.dashboard.destroy', $letter->id) }}" method="POST" class="d-inline">
                            @method('delete')
                            @csrf
                            <button class="btn btn-alt-danger btn-sm border-0" onclick="return confirm('Anda yakin menghapus data ini?')">
                                <i class="fas fa-times-circle"></i> Hapus
                            </button>
                        </form>
                    @else
                        <!-- Tombol Edit dan Hapus (disabled) jika status bukan pending -->
                        <a class="btn btn-secondary btn-sm disabled">
                            <i class="fas fa-edit"></i> Edit
                        </a>
                        <a class="btn btn-secondary btn-sm disabled">
                            <i class="fas fa-times-circle"></i> Hapus
                        </a>
                    @endif
                </td>
              </tr>
              @endforeach
          </tbody>
        </table>
        @endif
      </div>
    </div>
    <!-- END Dynamic Table with Export Buttons -->
  </div>
  <!-- END Page Content -->
@endsection
