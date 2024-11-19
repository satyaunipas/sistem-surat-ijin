@extends('dashboard')

@section('content')
                <!-- Page Content -->
                <div class="content content-boxed">
                  <!-- User Profile -->
                  <div class="block block-rounded">
                    <div class="block-header block-header-default">
                      <h3 class="block-title">Form Edit Data Jurusan</h3>
                    </div>
                    <div class="block-content">
                      <form action="/super_admin/data-jurusan/{{ $jurusan->id }}" method="POST" >
                        @method('put')
                        @csrf
                        <div class="row push">
                          <div class="col-lg-8 col-xl-5">
                            <div class="mb-4">
                              <label class="form-label" for="name">Nama Jurusan</label>
                              <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name', $jurusan->name) }}">
                              @error('name')
                              <div class="invalid-feedback">
                                {{ $message }}
                              </div>
                            @enderror
                            </div>
                            <div class="mb-4">
                              <button type="submit" class="btn btn-alt-primary">
                                Update
                              </button>
                            </div>
                          </div>
                        </div>
                    </div>
                  </div>
                  <!-- END User Profile -->
                </div>
                <!-- END Page Content -->
@endsection