@extends('layouts.simple')

@section('content')
        <!-- Page Content -->
        <div class="hero-static d-flex align-items-center">
          <div class="w-100">
            <!-- Sign In Section -->
            <div class="bg-body-extra-light">
              <div class="content content-full">
                <div class="row g-0 justify-content-center">
                  <div class="col-md-8 col-lg-6 col-xl-4 py-4 px-4 px-lg-5">
                    <!-- Header -->
                    <div class="text-center">

                      @if(session()->has('success'))
                      <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <strong>{{ session('success') }}</strong> Silahkan login.
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                      </div>
                      @endif

                      @if(session()->has('loginError'))
                      <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <strong>{{ session('loginError') }}</strong> Silahkan ulangi.
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                      </div>
                      @endif

                      <p class="mb-2">
                        <img src="{{ asset('media/favicons/logopnb.png') }}" alt="Logo PNB" style="width: 40px;">
                      </p>
                      <h1 class="h4 mb-1">
                        Sign In
                      </h1>
                      <p class="fw-medium text-muted mb-3">
                        Belum punya akun? <a href="/register">Register</a>
                      </p>
                    </div>
                    <!-- END Header -->

                    <!-- Sign In Form -->
                    <!-- jQuery Validation (.js-validation-signin class is initialized in js/pages/op_auth_signin.min.js which was auto compiled from _js/pages/op_auth_signin.js) -->
                    <!-- For more info and examples you can check out https://github.com/jzaefferer/jquery-validation -->
                    <form class="js-validation-signin" action="/login" method="POST">
                      @csrf
                      <div class="py-3">
                        <div class="mb-4">
                          <input type="text" class="form-control form-control-lg form-control-alt @error('identifier') is-invalid @enderror" 
                                 id="identifier" name="identifier" placeholder="NIP/Email/Username" autofocus required value="{{ old('identifier') }}">
                          @error('identifier')
                              <div class="invalid-feedback">
                                {{ $message }}
                              </div>
                          @enderror
                        </div>
                        <div class="mb-4">
                          <input type="password" class="form-control form-control-lg form-control-alt" id="password" name="password" placeholder="Password">
                        </div>
                      </div>
                      <div class="row justify-content-center">
                        <div class="col-lg-6 col-xxl-5">
                          <button type="submit" class="btn w-100 btn-alt-primary">
                            <i class="fa fa-fw fa-sign-in-alt me-1 opacity-50"></i> Login
                          </button>
                        </div>
                      </div>
                    </form>
                    <!-- END Sign In Form -->
                  </div>
                </div>
              </div>
            </div>
            <!-- END Sign In Section -->

            <!-- Footer -->
            <div class="fs-sm text-center text-muted py-3">
              Crafted with
                            <i class="fa fa-heart text-danger"></i> by
                            <a
                                class="fw-semibold"
                                href="https://www.linkedin.com/in/satyadjv/"
                                target="_blank"
                                >putu satya saputra</a
                            > &copy; <span data-toggle="year-copy"></span>
            </div>
            <!-- END Footer -->
          </div>
        </div>
        <!-- END Page Content -->
@endsection
