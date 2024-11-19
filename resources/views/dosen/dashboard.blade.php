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
        {{-- <a href="/mahasiswa/dashboard/create" class="btn btn-alt-primary mb-3">Tambah Pengajuan Surat</a> --}}

         <!-- Cek apakah ada surat yang diajukan -->
         @if($letters->isEmpty())
         <!-- Jika tidak ada surat, tampilkan pesan -->
          <div class="text-center">
              <h2>Belum ada pengajuan surat</h2>
          </div> 
         @else
        <!-- DataTables init on table by adding .js-dataTable-buttons class, functionality is initialized in js/pages/tables_datatables.js -->
        <table class="table table-bordered table-striped table-vcenter js-dataTable-buttons fs-sm">
          <thead>
            <tr>
              <th class="text-center">No</th>
              <th>Nama Pengirim</th>
              <th>Jenis surat</th>
              <th>Tanggal Ijin</th>
              <th>Status</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
              @foreach ($letters as $letter)
              <tr>
                <td class="text-center">{{ $loop->iteration }}</td>
                <td class="fw-semibold">{{ $letter->user->name }}
                </td>
                <td class="fw-semibold">{{ $letter->letterType->name }}
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
                <!-- Tombol Detail selalu muncul -->
                <a href="/dosen/dashboard/{{ $letter->id }}" class="btn btn-alt-info btn-sm">
                    <i class="fas fa-eye"></i> Detail
                </a>
                    @if($letter->status == 'pending')
                        <!-- Tombol Approve untuk status pending -->
                        <form id="approve-form-{{ $letter->id }}" action="{{ route('dosen.dashboard.approve', $letter->id) }}" method="POST" style="display:inline;">
                            @csrf
                            <a class="btn btn-alt-success btn-sm" 
                                onclick="if (confirm('Apakah Anda yakin ingin menyetujui surat ini?')) {
                                    document.getElementById('approve-form-{{ $letter->id }}').submit();
                                }">
                                <i class="fas fa-check-circle"></i> Approve
                            </a>
                        </form>
                
                        <!-- Tombol Reject untuk status pending -->
                        <form id="reject-form-{{ $letter->id }}" action="{{ route('dosen.dashboard.reject', $letter->id) }}" method="POST" style="display:inline;">
                            @csrf
                            <a class="btn btn-alt-danger btn-sm" 
                                onclick="if (confirm('Apakah Anda yakin ingin menolak surat ini?')) {
                                    document.getElementById('reject-form-{{ $letter->id }}').submit();
                                }">
                                <i class="fas fa-times-circle"></i> Reject
                            </a>
                        </form>
                
                    @elseif($letter->status == 'approved' || $letter->status == 'rejected')
                        <!-- Tombol Approve untuk status selain pending (disabled) -->
                        <a class="btn btn-secondary btn-sm disabled">
                            <i class="fas fa-check-circle"></i> Approve
                        </a>
                
                        <!-- Tombol Reject untuk status selain pending (disabled) -->
                        <a class="btn btn-secondary btn-sm disabled">
                            <i class="fas fa-times-circle"></i> Reject
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
