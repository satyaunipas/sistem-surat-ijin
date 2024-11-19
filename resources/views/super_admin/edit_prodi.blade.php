@extends('dashboard')

@section('content')
                <!-- Page Content -->
                <div class="content content-boxed">
                  <!-- User Profile -->
                  <div class="block block-rounded">
                      <div class="block-header block-header-default">
                          <h3 class="block-title">Form Edit Data Program Studi</h3>
                      </div>
                      <div class="block-content">
                          <form action="/super_admin/data-prodi/{{ $prodi->id }}" method="POST">
                              @method('put')
                              @csrf
                              <div class="row push justify-content-center">
                                  <div class="col-lg-8 col-xl-5">
                                      <!-- Nama Jurusan -->
                                      <div class="mb-4">
                                          <label class="form-label" for="jurusan_id">Nama Jurusan</label>
                                          <select class="form-select @error('jurusan_id') is-invalid @enderror" id="jurusan_id" name="jurusan_id">
                                              <option value="" disabled>Pilih Jurusan</option>
                                              @foreach ($jurusans as $jurusan)
                                                  <option value="{{ $jurusan->id }}" {{ old('jurusan_id', $prodi->jurusan_id) == $jurusan->id ? 'selected' : '' }}>
                                                      {{ $jurusan->name }}
                                                  </option>
                                              @endforeach
                                          </select>
                                          @error('jurusan_id')
                                              <div class="invalid-feedback">
                                                  {{ $message }}
                                              </div>
                                          @enderror
                                      </div>
              
                                      <!-- Nama Program Studi -->
                                      <div class="mb-4">
                                          <label class="form-label" for="name">Nama Program Studi</label>
                                          <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name', $prodi->name) }}">
                                          @error('name')
                                              <div class="invalid-feedback">
                                                  {{ $message }}
                                              </div>
                                          @enderror
                                      </div>
              
                                      <!-- Tombol Submit -->
                                      <div class="mb-4 text-center">
                                          <button type="submit" class="btn btn-alt-primary">
                                              Update
                                          </button>
                                      </div>
                                  </div>
                              </div>
                          </form>
                      </div>
                  </div>
                  <!-- END User Profile -->
              </div>
                <!-- END Page Content -->
@endsection