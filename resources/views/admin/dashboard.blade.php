@extends('dashboard')

@section('content')
          <!-- Page Content -->
          <div class="content">
            <div class="d-flex flex-column flex-md-row justify-content-md-between align-items-md-center py-2 text-center text-md-start">
              <div class="flex-grow-1 mb-1 mb-md-0">
                <h1 class="h3 fw-bold mb-1">
                  Dashboard
                </h1>
                <h2 class="h6 fw-medium fw-medium text-muted mb-0">
                  Welcome <a class="fw-semibold">{{ Auth::user()->name }}</a>, everything looks great.
                </h2>
              </div>
            </div>
          </div>
          <!-- END Page Content -->
          <!-- Overview -->
          <div class="content">
          <div class="row items-push">
            <div class="col-sm-6 col-xxl-3">
              <!-- Pending Orders -->
              <div class="block block-rounded d-flex flex-column h-100 mb-0">
                <div class="block-content block-content-full flex-grow-1 d-flex justify-content-between align-items-center">
                  <dl class="mb-0">
                    <dt class="fs-3 fw-bold">{{ $jumlahDosen }}</dt>
                    <dd class="fs-sm fw-medium fs-sm fw-medium text-muted mb-0">Dosen</dd>
                  </dl>
                  <div class="item item-rounded-lg bg-body-light">
                    <i class="si si-users fs-3 text-primary"></i>
                  </div>
                </div>
                <div class="bg-body-light rounded-bottom">
                  <a class="block-content block-content-full block-content-sm fs-sm fw-medium d-flex align-items-center justify-content-between" href="/admin/data-dosen">
                    <span>Lihat data dosen</span>
                    <i class="fa fa-arrow-alt-circle-right ms-1 opacity-25 fs-base"></i>
                  </a>
                </div>
              </div>
              <!-- END Pending Orders -->
            </div>
            <div class="col-sm-6 col-xxl-3">
              <!-- New Customers -->
              <div class="block block-rounded d-flex flex-column h-100 mb-0">
                <div class="block-content block-content-full flex-grow-1 d-flex justify-content-between align-items-center">
                  <dl class="mb-0">
                    <dt class="fs-3 fw-bold">{{ $jumlahMahasiswa }}</dt>
                    <dd class="fs-sm fw-medium fs-sm fw-medium text-muted mb-0">Mahasiswa</dd>
                  </dl>
                  <div class="item item-rounded-lg bg-body-light">
                    <i class="fa fa-users fs-3 text-primary"></i>
                  </div>
                </div>
                <div class="bg-body-light rounded-bottom">
                  <a class="block-content block-content-full block-content-sm fs-sm fw-medium d-flex align-items-center justify-content-between" href="/admin/data-mahasiswa">
                    <span>Lihat data mahasiswa</span>
                    <i class="fa fa-arrow-alt-circle-right ms-1 opacity-25 fs-base"></i>
                  </a>
                </div>
              </div>
              <!-- END New Customers -->
            </div>
            <div class="col-sm-6 col-xxl-3">
              <!-- Messages -->
              <div class="block block-rounded d-flex flex-column h-100 mb-0">
                <div class="block-content block-content-full flex-grow-1 d-flex justify-content-between align-items-center">
                  <dl class="mb-0">
                    <dt class="fs-3 fw-bold">{{ $jumlahProdi }}</dt>
                    <dd class="fs-sm fw-medium fs-sm fw-medium text-muted mb-0">Prodi</dd>
                  </dl>
                  <div class="item item-rounded-lg bg-body-light">
                    <i class="fa fa-building-user fs-3 text-primary"></i>
                  </div>
                </div>
                <div class="bg-body-light rounded-bottom">
                  <a class="block-content block-content-full block-content-sm fs-sm fw-medium d-flex align-items-center justify-content-between" href="/admin/data-prodi">
                    <span>Lihat data prodi</span>
                    <i class="fa fa-arrow-alt-circle-right ms-1 opacity-25 fs-base"></i>
                  </a>
                </div>
              </div>
              <!-- END Messages -->
            </div>
            <div class="col-sm-6 col-xxl-3">
              <!-- Messages -->
              <div class="block block-rounded d-flex flex-column h-100 mb-0">
                <div class="block-content block-content-full flex-grow-1 d-flex justify-content-between align-items-center">
                  <dl class="mb-0">
                    <dt class="fs-3 fw-bold">{{ $jumlahSurat }}</dt>
                    <dd class="fs-sm fw-medium fs-sm fw-medium text-muted mb-0">Surat</dd>
                  </dl>
                  <div class="item item-rounded-lg bg-body-light">
                    <i class="si si-envelope-letter fs-3 text-primary"></i>
                  </div>
                </div>
                <div class="bg-body-light rounded-bottom">
                  <a class="block-content block-content-full block-content-sm fs-sm fw-medium d-flex align-items-center justify-content-between" href="/admin/data-surat">
                    <span>Lihat data surat</span>
                    <i class="fa fa-arrow-alt-circle-right ms-1 opacity-25 fs-base"></i>
                  </a>
                </div>
              </div>
              <!-- END Messages -->
            </div>
          </div>
          </div>
          <!-- END Overview -->
@endsection