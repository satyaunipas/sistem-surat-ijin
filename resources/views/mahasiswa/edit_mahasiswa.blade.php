@extends('dashboard')

@section('content')
                <!-- Page Content -->
                <div class="content content-boxed">
                  <!-- User Profile -->
                  <div class="block block-rounded">
                    <div class="block-header block-header-default">
                      <h3 class="block-title">Form Edit Data Mahasiswa</h3>
                      
                    </div>
                    <div class="block-content">
                      @if(session()->has('success'))
                      <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <strong>{{ session('success') }}</strong>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                      </div>
                      @endif
                      <form action="{{ route('mahasiswa.update', $mahasiswa->username) }}" method="POST">
                        @method('put')
                        @csrf
                        <div class="row push">
                          <div class="col-lg-4">
                            <p class="fs-sm text-muted">
                              Your account’s vital info. Your username will be publicly visible.
                            </p>
                          </div>
                          <div class="col-lg-8 col-xl-5">
                            <div class="mb-4">
                              <label class="form-label" for="name">Nama Mahasiswa</label>
                              <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name', $mahasiswa->name) }}">
                              @error('name')
                              <div class="invalid-feedback">
                                {{ $message }}
                              </div>
                            @enderror
                            </div>
                            <div class="mb-4">
                              <label class="form-label" for="username">Username</label>
                              <input type="text" class="form-control @error('username') is-invalid @enderror" id="username" name="username" value="{{ old('username', $mahasiswa->username) }}">
                              @error('username')
                              <div class="invalid-feedback">
                                {{ $message }}
                              </div>
                            @enderror
                            </div>
                            <div class="mb-4">
                              <label class="form-label" for="nomor_induk">NIM</label>
                              <input type="text" class="form-control @error('nomor_induk') is-invalid @enderror" id="nomor_induk" name="nomor_induk" value="{{ old('nomor_induk', $mahasiswa->nomor_induk) }}">
                              @error('nomor_induk')
                              <div class="invalid-feedback">
                                {{ $message }}
                              </div>
                            @enderror
                            </div>
                            <div class="mb-4">
                              <label class="form-label" for="alamat">Alamat</label>
                              <input type="text" class="form-control @error('alamat') is-invalid @enderror" id="alamat" name="alamat" value="{{ old('alamat', $mahasiswa->alamat) }}">
                              @error('alamat')
                              <div class="invalid-feedback">
                                {{ $message }}
                              </div>
                            @enderror
                            </div>
                            <div class="mb-4">
                              <label class="form-label" for="phone_number">Telepon</label>
                              <input type="text" class="form-control @error('phone_number') is-invalid @enderror" id="phone_number" name="phone_number" value="{{ old('phone_number', $mahasiswa->phone_number) }}">
                              @error('phone_number')
                              <div class="invalid-feedback">
                                {{ $message }}
                              </div>
                            @enderror
                            </div>
                            <div class="mb-4">
                              <label class="form-label" for="email">Email Address</label>
                              <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email', $mahasiswa->email) }}" >
                              @error('email')
                              <div class="invalid-feedback">
                                {{ $message }}
                              </div>
                            @enderror
                            </div>
                            <div class="mb-4">
                              <label class="form-label" for="jurusan_id">Jurusan</label>
                              <select class="form-select @error('jurusan_id') is-invalid @enderror" id="jurusan_id" name="jurusan_id">
                                  <option value="" disabled selected>Pilih Jurusan</option>
                                  @foreach ( $jurusans as $jurusan)
                                    @if(old('jurusan_id', $mahasiswa->jurusan_id) == $jurusan->id)
                                    <option value="{{ $jurusan->id }}" selected>{{ $jurusan->name }}</option>
                                    @else
                                    <option value="{{ $jurusan->id }}">{{ $jurusan->name }}</option>
                                    @endif
                                  @endforeach
                              </select>
                              @error('jurusan_id')
                              <div class="invalid-feedback">
                                {{ $message }}
                              </div>
                              @enderror
                            </div>
                            <div class="mb-4">
                              <label class="form-label" for="program_study_id">Program Studi</label>
                              <select class="form-select @error('program_study_id') is-invalid @enderror" id="program_study_id" name="program_study_id" >
                                  <option value="" disabled selected>Pilih Prodi</option>
                                  @foreach ( $prodis as $prodi)
                                    @if(old('program_study_id', $mahasiswa->program_study_id) == $prodi->id)
                                    <option value="{{ $prodi->id }}" selected>{{ $prodi->name }}</option>
                                    @else
                                    <option value="{{ $prodi->id }}" >{{ $prodi->name }}</option>
                                    @endif
                                  @endforeach
                              </select>
                              @error('program_study_id')
                              <div class="invalid-feedback">
                                {{ $message }}
                              </div>
                              @enderror
                            </div>
                            <div class="mb-4">
                              <label class="form-label">Your Avatar</label>
                              <div class="mb-4">
                                <img class="img-avatar" src="{{ asset('media/avatars/avatar13.jpg') }}" alt="">
                              </div>
                              <div class="mb-4">
                                <label for="avatar" class="form-label">Choose a new avatar</label>
                                <input class="form-control @error('avatar') is-invalid @enderror" type="file" id="avatar" value="{{ old('avatar') }}">
                                @error('avatar')
                                <div class="invalid-feedback">
                                  {{ $message }}
                                </div>
                                @enderror
                              </div>
                            </div>
                            <div class="mb-4">
                            </div>
                          </div>
                        </div>
                    </div>
                  </div>
                  <!-- END User Profile -->
        
                  <!-- Change Password -->
                  <div class="block block-rounded">
                    <div class="block-header block-header-default">
                      <h3 class="block-title"> Password</h3>
                    </div>
                    <div class="block-content">
                        <div class="row push">
                          <div class="col-lg-4">
                            <p class="fs-sm text-muted">
                              Changing your sign in password is an easy way to keep your account secure.
                            </p>
                          </div>
                          <div class="col-lg-8 col-xl-5">
                            <div class="row mb-4">
                              <div class="col-12">
                                <label class="form-label" for="opassword"> Password</label>
                                <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password">
                                @error('password')
                                  <div class="invalid-feedback">
                                    {{ $message }}
                                  </div>
                                @enderror
                              </div>
                            </div>
                            <div class="row mb-4">
                              <div class="col-12">
                                <label class="form-label" for="password_confirmation">Confirm Password</label>
                                <input type="password" class="form-control @error('password_confirmation') is-invalid @enderror" id="password_confirmation" name="password_confirmation">
                                @error('password_confirmation')
                                  <div class="invalid-feedback">
                                    {{ $message }}
                                  </div>
                                @enderror
                              </div>
                            </div>
                            <div class="mb-4">
                              <button type="submit" class="btn btn-alt-primary">
                                Update Data
                              </button>
                            </div>
                          </div>
                        </div>
                      </form>
                    </div>
                  </div>
                  <!-- END Change Password -->
                </div>
                <!-- END Page Content -->
@endsection