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
              Data Admin Jurusan
          </h3>
      </div>
      <div class="block-content block-content-full">
          @if(session()->has('success'))
              <div class="alert alert-success alert-dismissible fade show" role="alert">
                  <strong>{{ session('success') }}</strong>
                  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>
          @endif
          <a href="/super_admin/admin-jurusan/create" class="btn btn-alt-primary mb-3">Tambah Data Admin</a>
          <!-- DataTables init on table by adding .js-dataTable-buttons class, functionality is initialized in js/pages/tables_datatables.js -->
          <table class="table table-bordered table-striped table-vcenter js-dataTable-buttons fs-sm">
              <thead>
                  <tr>
                      <th class="text-center">No</th>
                      <th>Admin</th>
                      <th>Email</th>
                      <th>Jurusan</th>
                      <th>Prodi</th>
                      <th>Action</th>
                  </tr>
              </thead>
              <tbody>
                  @foreach ($jurusans as $jurusan)
                  <tr>
                      <td class="text-center">{{ $loop->iteration }}</td>
                      
                      {{-- Display Admin Name --}}
                      <td class="fw-semibold">
                          {{ $jurusan->admin->name ?? '-' }}
                      </td>
                      
                      {{-- Display Admin Email --}}
                      <td>
                          {{ $jurusan->admin->email ?? '-' }}
                      </td>

                      {{-- Display Jurusan Name --}}
                      <td class="fw-semibold">
                          {{ $jurusan->name }}
                      </td>

                      {{-- Display Number of Prodi --}}
                      <td>
                          {{ $jurusan->prodi->count() }}
                      </td>

                      {{-- Action Buttons --}}
                      <td>
                        <a href="/super_admin/admin-jurusan/{{ $jurusan->admin->username ?? '' }}" 
                          class="btn btn-alt-info btn-sm"
                          @if(!$jurusan->admin) style="pointer-events: none; opacity: 0.5;" @endif>
                          <i class="fas fa-eye"></i> Detail
                       </a>
                       
                       <a href="/super_admin/admin-jurusan/{{ $jurusan->admin->username ?? '' }}/edit" 
                          class="btn btn-alt-success btn-sm"
                          @if(!$jurusan->admin) style="pointer-events: none; opacity: 0.5;" @endif>
                          <i class="fas fa-edit"></i> Edit
                       </a>
                       
                       <form action="/super_admin/admin-jurusan/{{ $jurusan->admin->username ?? '' }}" 
                             method="POST" 
                             class="d-inline">
                           @method('delete')
                           @csrf
                           <button class="btn btn-alt-danger btn-sm border-0" 
                                   onclick="return confirm('Anda yakin menghapus data ini?')" 
                                   @if(!$jurusan->admin) disabled @endif>
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