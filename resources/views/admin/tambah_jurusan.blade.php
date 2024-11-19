@extends('dashboard')

@section('content')
                <!-- Page Content -->
                <div class="content content-boxed">
                  <!-- User Profile -->
                  <div class="block block-rounded">
                    <div class="block-header block-header-default">
                      <h3 class="block-title">Form Tambah Data Jurusan</h3>
                    </div>
                    <div class="block-content">
                      <form action="/admin/data-jurusan" method="POST" >
                        @csrf
                        <div class="row push">
                          <div class="col-lg-4">
                          </div>
                          <div class="col-lg-8 col-xl-5">
                            <div class="mb-4">
                              <label class="form-label" for="name">Nama Jurusan</label>
                              <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name') }}">
                              @error('name')
                              <div class="invalid-feedback">
                                {{ $message }}
                              </div>
                            @enderror
                            </div>
                            <div class="mb-4">
                              <button type="submit" class="btn btn-alt-primary">
                                Tambah
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