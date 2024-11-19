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

  <style>
      .switch {
          position: relative;
          display: inline-block;
          width: 34px;
          height: 20px;
      }

      .switch input {
          opacity: 0;
          width: 0;
          height: 0;
      }

      .slider {
          position: absolute;
          cursor: pointer;
          top: 0;
          left: 0;
          right: 0;
          bottom: 0;
          background-color: #ccc;
          transition: 0.4s;
          border-radius: 20px;
      }

      .slider:before {
          position: absolute;
          content: "";
          height: 14px;
          width: 14px;
          left: 3px;
          bottom: 3px;
          background-color: white;
          transition: 0.4s;
          border-radius: 50%;
      }

      input:checked + .slider {
          background-color: #4CAF50;
      }

      input:checked + .slider:before {
          transform: translateX(14px);
      }
  </style>

@endsection

@section('content')

  <!-- Page Content -->
  <div class="content">

    <!-- Dynamic Table with Export Buttons -->
    <div class="block block-rounded">
      <div class="block-header block-header-default">
        <h3 class="block-title">
          Data Dosen
        </h3>
      </div>
      <div class="block-content block-content-full">
        @if(session()->has('success'))
                      <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <strong>{{ session('success') }}</strong>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                      </div>
                      @endif
        <a href="/admin/data-dosen/create" class="btn btn-alt-primary mb-3">Tambah Data Dosen</a>
        <!-- DataTables init on table by adding .js-dataTable-buttons class, functionality is initialized in js/pages/tables_datatables.js -->
        <table class="table table-bordered table-striped table-vcenter js-dataTable-buttons fs-sm">
          <thead>
            <tr>
              <th class="text-center">No</th>
              <th>Nama Dosen</th>
              <th class="d-none d-sm-table-cell" >NIP</th>
              <th>Email</th>
              <th>Pimpinan</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
              @foreach ($dosens as $dosen)
              <tr>
                <td class="text-center">{{ $loop->iteration }}</td>
                <td class="fw-semibold">{{ $dosen->name }}
                </td>
                <td class="d-none d-sm-table-cell">{{ $dosen->nomor_induk }}
                </td>
                <td class="text-muted">{{ $dosen->email }}
                </td>
                <td class="text-center">
                    <label class="switch">
                        <input 
                            type="checkbox" 
                            class="toggle-pejabat" 
                            data-id="{{ $dosen->id }}" 
                            {{ $dosen->status == 2 ? 'checked' : '' }}
                        >
                        <span class="slider"></span>
                    </label>
                </td>
                <td>
                  <a href="/admin/data-dosen/{{ $dosen->username }}" class="btn btn-alt-info btn-sm">
                    <i class="fas fa-eye"></i> Detail
                  </a>
                  <a href="/admin/data-dosen/{{ $dosen->username }}/edit" class="btn btn-alt-success btn-sm">
                    <i class="fas fa-edit"></i> Edit
                  </a>
                  <form action="/admin/data-dosen/{{ $dosen->username }}" method="POST" class="d-inline">
                    @method('delete')
                    @csrf
                    <button class="btn btn-alt-danger btn-sm border-0" onclick="return confirm('Anda yakin menghapus data ini?')">
                      <i class="fas fa-times-circle"></i> Hapus
                    </button>
                  </form>
                </td>
              </tr>
              @endforeach
          </tbody>
        </table>
      </div>
    </div>
    <!-- END Dynamic Table with Export Buttons -->
  </div>
  <!-- END Page Content -->
  <script>
      $(document).ready(function() {
          $('.toggle-pejabat').change(function() {
              let status = $(this).prop('checked') ? 2 : 1;
              let dosenId = $(this).data('id');
              
              $.ajax({
                  url: '/admin/data-dosen/' + dosenId + '/update-status',
                  method: 'POST',
                  data: {
                      _token: '{{ csrf_token() }}',
                      status: status
                  },
                  success: function(response) {
                      alert(response.message); // Menampilkan pesan konfirmasi
                  },
                  error: function(xhr) {
                      alert('Terjadi kesalahan, silakan coba lagi.');
                  }
              });
          });
      });
  </script>
@endsection
