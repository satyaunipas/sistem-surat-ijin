@extends('layouts.simple')

@section('content')
        <!-- Page Content -->
        <div class="hero-static d-flex align-items-center">
          <div class="content">
            <div class="row justify-content-center push">
              <div class="col-md-8 col-lg-6 col-xl-4">
                <!-- Sign Up Block -->
                <div class="block block-rounded mb-0">
                  <div class="block-header block-header-default">
                    <h3 class="block-title">Buat Akun</h3>
                    <div class="block-options">
                      <a class="btn-block-option" href="/login" data-bs-toggle="tooltip" data-bs-placement="left" title="Login">
                        <i class="fa fa-sign-in-alt"></i>
                      </a>
                    </div>
                  </div>
                  <div class="block-content">
                    <div class="p-sm-3 px-lg-4 px-xxl-5 py-lg-3">
                      <p class="fw-medium text-muted">
                        Please fill the following details to create a new account.
                      </p>

                      <form class="js-validation-signup" action="/register" method="POST">
                        @csrf
                        <div class="py-3">
                          <div class="mb-4">
                            <input type="text" class="form-control form-control-lg form-control-alt @error('username') is-invalid @enderror" id="username" name="username" placeholder="Username" required value="{{ old('username') }}">
                            @error('username')
                              <div class="invalid-feedback">
                                {{ $message }}
                              </div>
                            @enderror
                          </div>
                          <div class="mb-4">
                            <input type="email" class="form-control form-control-lg form-control-alt @error('email') is-invalid @enderror" id="email" name="email" placeholder="Email" required value="{{ old('email') }}">
                            @error('email')
                              <div class="invalid-feedback">
                                {{ $message }}
                              </div>
                            @enderror
                          </div>
                          <div class="mb-4">
                            <input type="password" class="form-control form-control-lg form-control-alt @error('password') is-invalid @enderror" id="password" name="password" placeholder="Password">
                            @error('password')
                              <div class="invalid-feedback">
                                {{ $message }}
                              </div>
                            @enderror
                          </div>
                          <div class="mb-4">
                            <input type="password" class="form-control form-control-lg form-control-alt @error('password_confirmation') is-invalid @enderror" id="password_confirmation" name="password_confirmation" placeholder="Confirm Password">
                            @error('password_confirmation')
                              <div class="invalid-feedback">
                                {{ $message }}
                              </div>
                            @enderror
                          </div>
                          <div class="mb-4">
                            <select name="role" class="form-control form-control-lg form-control-alt @error('role') is-invalid @enderror" aria-label="Default select example" required>
                              <option value="" disabled {{ old('role') ? '' : 'selected' }}>Pilih Peran</option>
                              <option value="mahasiswa" {{ old('role') === 'mahasiswa' ? 'selected' : '' }}>Mahasiswa</option>
                              <option value="dosen" {{ old('role') === 'dosen' ? 'selected' : '' }}>Dosen</option>
                          </select>
                            @error('role')
                              <div class="invalid-feedback">
                                {{ $message }}
                              </div>
                            @enderror
                          </div>
                        </div>
                        <div class="row mb-4">
                          <div class="col-md-6 col-xl-5">
                            <button type="submit" class="btn w-100 btn-alt-success">
                              <i class="fa fa-fw fa-plus me-1 opacity-50"></i> Sign Up
                            </button>
                          </div>
                        </div>
                      </form>
                      <!-- END Sign Up Form -->
                    </div>
                  </div>
                </div>
                <!-- END Sign Up Block -->
              </div>
            </div>
            <div class="fs-sm text-muted text-center">
              Crafted with
                            <i class="fa fa-heart text-danger"></i> by
                            <a
                                class="fw-semibold"
                                href="https://www.linkedin.com/in/satyadjv/"
                                target="_blank"
                                >putu satya saputra</a
                            > &copy; <span data-toggle="year-copy"></span>
            </div>
          </div>
        </div>
        <!-- END Page Content -->
@endsection
