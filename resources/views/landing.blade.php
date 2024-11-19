@extends('layouts.landing')

@section('content')
        <!-- Hero -->
        <div class="bg-image" style="background-image: url('{{ asset('/media/photos/akuntansi.jpeg') }}');">
          <div class="bg-primary-dark-op py-9 overflow-hidden">
            <div class="content content-full text-center">
              <h1 class="display-4 fw-semibold text-white mb-2">
                E-LISMA
              </h1>
              <p class="fs-4 fw-normal text-white-50 mb-5">
                Electronic Letter for Student Absence
              </p>
              <div>
                  @guest
                      <!-- Jika user belum login, tampilkan tombol login dan daftar -->
                      <a class="btn btn-primary px-3 py-2 m-1" href="/login">
                          <i class="fa fa-fw fa-link opacity-50 me-1"></i> Buat Surat Pengajuan
                      </a>
                      <a class="btn btn-dark px-3 py-2 m-1" href="/register">
                          <i class="fa fa-fw fa-link opacity-50 me-1"></i> Daftar Akun
                      </a>
                  @endguest
              
                  @auth
                      <!-- Jika user sudah login, cek role-nya untuk mengarahkan ke dashboard yang sesuai -->
                      @if(auth()->user()->role == 'mahasiswa')
                          <a class="btn btn-primary px-3 py-2 m-1" href="/mahasiswa/dashboard">
                              <i class="fa fa-fw fa-link opacity-50 me-1"></i> Buat Surat Pengajuan
                          </a>
                      @elseif(auth()->user()->role == 'dosen')
                          <a class="btn btn-primary px-3 py-2 m-1" href="/dosen/dashboard">
                              <i class="fa fa-fw fa-link opacity-50 me-1"></i> Dashboard Dosen
                          </a>
                      @elseif(auth()->user()->role == 'admin')
                          <a class="btn btn-primary px-3 py-2 m-1" href="/admin/dashboard">
                              <i class="fa fa-fw fa-link opacity-50 me-1"></i> Dashboard Admin
                          </a>
                      @elseif(auth()->user()->role == 'super_admin')
                          <a class="btn btn-primary px-3 py-2 m-1" href="/super_admin/dashboard">
                              <i class="fa fa-fw fa-link opacity-50 me-1"></i> Dashboard Super Admin
                          </a>
                      @endif
                  @endauth
              </div>
            </div>
          </div>
        </div>
        <!-- END Hero -->

        <!-- Section 1 -->
        <div class="bg-body-extra-light">
          <div class="content content-full">
            <div class="py-5 text-center push">
              <h2 class="h1 mb-0" id="feature">
                Electronic Letter for Student Absence
              </h2>
            </div>
            <div class="text-center">
              <p>
                Electronic Letter for Student Absence adalah platform berbasis web yang dirancang khusus untuk mempermudah mahasiswa dalam mengajukan permohonan izin tidak masuk kuliah secara elektronik. Sistem ini mendigitalisasi proses pengajuan izin, mulai dari pengajuan oleh mahasiswa hingga persetujuan oleh dosen atau pihak terkait, memastikan bahwa seluruh proses izin berjalan lebih efisien, cepat, dan terdokumentasi dengan baik.
              </p>
            </div>
          </div>
        </div>
        <!-- END Section 1 -->
@endsection
