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
          Data Mahasiswa
        </h3>
      </div>
      <div class="block-content block-content-full">
        @if(session()->has('success'))
                      <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <strong>{{ session('success') }}</strong>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                      </div>
                      @endif
        <a href="/admin/data-mahasiswa/create" class="btn btn-alt-primary mb-3">Tambah Data Mahasiswa</a>
        <!-- DataTables init on table by adding .js-dataTable-buttons class, functionality is initialized in js/pages/tables_datatables.js -->
        <table class="table table-bordered table-striped table-vcenter js-dataTable-buttons fs-sm">
          <thead>
            <tr>
              <th class="text-center">No</th>
              <th>Nama Mahasiswa</th>
              <th class="d-none d-sm-table-cell" >NIM</th>
              <th>Email</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
              @foreach ($mahasiswas as $mahasiswa)
              <tr>
                <td class="text-center">{{ $loop->iteration }}</td>
                <td class="fw-semibold">{{ $mahasiswa->name }}
                </td>
                <td class="d-none d-sm-table-cell">{{ $mahasiswa->nomor_induk }}
                </td>
                <td class="text-muted">{{ $mahasiswa->email }}
                </td>
                <td>
                  <a href="/admin/data-mahasiswa/{{ $mahasiswa->username }}" class="btn btn-alt-info btn-sm">
                    <i class="fas fa-eye"></i> Detail
                  </a>
                  <a href="/admin/data-mahasiswa/{{ $mahasiswa->username }}/edit" class="btn btn-alt-success btn-sm">
                    <i class="fas fa-edit"></i> Edit
                  </a>
                  <form action="/admin/data-mahasiswa/{{ $mahasiswa->username }}" method="POST" class="d-inline">
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
@endsection
