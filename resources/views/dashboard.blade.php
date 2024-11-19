<!doctype html>
<html lang="{{ config('app.locale') }}">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">

  <title>Electronic Letter for Student Absence</title>

  <meta name="description" content="Electronic Letter for Student Absence">
  <meta name="author" content="pixelcave">
  <meta name="robots" content="noindex, nofollow">

  <!-- Icons -->
  <link rel="shortcut icon" href="{{ asset('media/favicons/pnb.png') }}">
  <link rel="icon" sizes="192x192" type="image/png" href="{{ asset('media/favicons/pnb.png') }}">
  <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('media/favicons/apple-touch-icon-180x180.png') }}">

  <!-- Modules -->
  @yield('css')
  @vite(['resources/sass/main.scss', 'resources/js/oneui/app.js'])
  @yield('js')
</head>

<body>
  <div
  id="page-container"
  class="sidebar-o sidebar-dark enable-page-overlay side-scroll page-header-fixed main-content-narrow"
>
  <!-- Sidebar -->
  <nav id="sidebar" aria-label="Main Navigation">
      <!-- Side Header -->
      <div class="content-header">
          <!-- Logo -->
          <a class="fw-semibold text-dual" href="#">
              <span class="smini-visible">
                  <i class="fa fa-circle-notch text-primary"></i>
              </span>
              <span class="smini-hide fs-5 tracking-wider">
                    @if(auth()->user()->role == 'admin')
                        Admin
                    @elseif(auth()->user()->role == 'dosen')
                        Dosen
                    @elseif(auth()->user()->role == 'mahasiswa')
                        Mahasiswa
                    @elseif(auth()->user()->role == 'super_admin')
                        Super Admin
                    @endif
                </span>
          </a>
          <!-- END Logo -->

          <!-- Options -->
          <div>
              <!-- Dark Mode -->
              <!-- Layout API, functionality initialized in Template._uiApiLayout() -->
              <button
                  type="button"
                  class="btn btn-sm btn-alt-secondary"
                  data-toggle="layout"
                  data-action="dark_mode_toggle"
              >
                  <i class="far fa-moon"></i>
              </button>
              <!-- END Dark Mode -->

              <!-- Options -->
              <div class="dropdown d-inline-block ms-1">
                  <button
                      type="button"
                      class="btn btn-sm btn-alt-secondary"
                      id="sidebar-themes-dropdown"
                      data-bs-toggle="dropdown"
                      aria-haspopup="true"
                      aria-expanded="false"
                  >
                      <i class="fa fa-brush"></i>
                  </button>
                  <div
                      class="dropdown-menu dropdown-menu-end fs-sm smini-hide border-0"
                      aria-labelledby="sidebar-themes-dropdown"
                  >
                      <div class="dropdown-divider"></div>

                      <!-- Sidebar Styles -->
                      <!-- Layout API, functionality initialized in Template._uiApiLayout() -->
                      <a
                          class="dropdown-item fw-medium"
                          data-toggle="layout"
                          data-action="sidebar_style_light"
                          href="javascript:void(0)"
                      >
                          <span>Sidebar Light</span>
                      </a>
                      <a
                          class="dropdown-item fw-medium"
                          data-toggle="layout"
                          data-action="sidebar_style_dark"
                          href="javascript:void(0)"
                      >
                          <span>Sidebar Dark</span>
                      </a>
                      <!-- END Sidebar Styles -->

                      <div class="dropdown-divider"></div>

                      <!-- Header Styles -->
                      <!-- Layout API, functionality initialized in Template._uiApiLayout() -->
                      <a
                          class="dropdown-item fw-medium"
                          data-toggle="layout"
                          data-action="header_style_light"
                          href="javascript:void(0)"
                      >
                          <span>Header Light</span>
                      </a>
                      <a
                          class="dropdown-item fw-medium"
                          data-toggle="layout"
                          data-action="header_style_dark"
                          href="javascript:void(0)"
                      >
                          <span>Header Dark</span>
                      </a>
                      <!-- END Header Styles -->
                  </div>
              </div>
              <!-- END Options -->

              <!-- Close Sidebar, Visible only on mobile screens -->
              <!-- Layout API, functionality initialized in Template._uiApiLayout() -->
              <a
                  class="d-lg-none btn btn-sm btn-alt-secondary ms-1"
                  data-toggle="layout"
                  data-action="sidebar_close"
                  href="javascript:void(0)"
              >
                  <i class="fa fa-fw fa-times"></i>
              </a>
              <!-- END Close Sidebar -->
          </div>
          <!-- END Options -->
      </div>
      <!-- END Side Header -->

      <!-- Sidebar Scrolling -->
      <div class="js-sidebar-scroll">
          <!-- Side Navigation -->
          <div class="content-side">
              <!-- Navigasi Sidebar Berbeda untuk Mahasiswa/Dosen/Admin -->
              @if(Auth::user()->role == 'mahasiswa')
              @include('layouts.nav_mahasiswa')
                @elseif(Auth::user()->role == 'dosen')
                    @include('layouts.nav_dosen')
                @elseif(Auth::user()->role == 'admin')
                    @include('layouts.nav_admin')
                @elseif(Auth::user()->role == 'super_admin')
                    @include('layouts.nav_super_admin')
                @endif
          </div>
          <!-- END Side Navigation -->
      </div>
      <!-- END Sidebar Scrolling -->
  </nav>
  <!-- END Sidebar -->

  <!-- Header -->
  <header id="page-header">
      <!-- Header Content -->
      <div class="content-header">
          <!-- Left Section -->
          <div class="d-flex align-items-center">
              <!-- Toggle Sidebar -->
              <!-- Layout API, functionality initialized in Template._uiApiLayout()-->
              <button
                  type="button"
                  class="btn btn-sm btn-alt-secondary me-2 d-lg-none"
                  data-toggle="layout"
                  data-action="sidebar_toggle"
              >
                  <i class="fa fa-fw fa-bars"></i>
              </button>
              <!-- END Toggle Sidebar -->

              <!-- Toggle Mini Sidebar -->
              <!-- Layout API, functionality initialized in Template._uiApiLayout()-->
              <button
                  type="button"
                  class="btn btn-sm btn-alt-secondary me-2 d-none d-lg-inline-block"
                  data-toggle="layout"
                  data-action="sidebar_mini_toggle"
              >
                  <i class="fa fa-fw fa-ellipsis-v"></i>
              </button>
              <!-- END Toggle Mini Sidebar -->

              <!-- Open Search Section (visible on smaller screens) -->
              <!-- Layout API, functionality initialized in Template._uiApiLayout() -->
              <button
                  type="button"
                  class="btn btn-sm btn-alt-secondary d-sm-none"
                  data-toggle="layout"
                  data-action="header_search_on"
              >
                  <i class="si si-magnifier"></i>
              </button>
              <!-- END Open Search Section -->

              <!-- Search Form (visible on larger screens) -->
              <form class="d-none d-sm-inline-block" method="POST">
                  <div class="input-group input-group-sm">
                      <input
                          type="text"
                          class="form-control form-control-alt"
                          placeholder="Search.."
                          id="page-header-search-input2"
                          name="page-header-search-input2"
                      />
                      <span class="input-group-text bg-body border-0">
                          <i class="si si-magnifier"></i>
                      </span>
                  </div>
              </form>
              <!-- END Search Form -->
          </div>
          <!-- END Left Section -->

          <!-- Right Section -->
          <div class="d-flex align-items-center">
              <!-- User Dropdown -->
              <div class="dropdown d-inline-block ms-2">
                  <button
                      type="button"
                      class="btn btn-sm btn-alt-secondary d-flex align-items-center"
                      id="page-header-user-dropdown"
                      data-bs-toggle="dropdown"
                      aria-haspopup="true"
                      aria-expanded="false"
                  >
                      <img
                          class="rounded-circle"
                          src="{{ asset('/media/avatars/avatar10.jpg') }}"
                          alt="Header Avatar"
                          style="width: 21px"
                      />
                      <span class="d-none d-sm-inline-block ms-2"
                          >{{ auth()->user()->name }}</span
                      >
                      <i
                          class="fa fa-fw fa-angle-down d-none d-sm-inline-block ms-1 mt-1"
                      ></i>
                  </button>
                  <div
                      class="dropdown-menu dropdown-menu-md dropdown-menu-end p-0 border-0"
                      aria-labelledby="page-header-user-dropdown"
                  >
                      <div
                          class="p-3 text-center bg-body-light border-bottom rounded-top"
                      >
                          <img
                              class="img-avatar img-avatar48 img-avatar-thumb"
                              src="{{ asset('/media/avatars/avatar10.jpg') }}"
                              alt=""
                          />
                          <p class="mt-2 mb-0 fw-medium">
                              {{ auth()->user()->name }}
                          </p>
                          <p class="mb-0 text-muted fs-sm fw-medium">
                            @if(auth()->user()->role == 'admin')
                                Admin
                            @elseif(auth()->user()->role == 'dosen')
                                Dosen
                            @elseif(auth()->user()->role == 'mahasiswa')
                                Mahasiswa
                            @elseif(auth()->user()->role == 'super_admin')
                                Super Admin
                            @endif
                          </p>
                      </div>
                      <div
                          role="separator"
                          class="dropdown-divider m-0"
                      ></div>
                      <div class="p-2">
                        <form action="/logout" method="POST">
                            @csrf
                          <button type="submit"
                              class="dropdown-item d-flex align-items-center justify-content-between"
                          >
                              <span class="fs-sm fw-medium"
                                  >Log Out</span
                              >
                          </button>
                        </form>
                      </div>
                  </div>
              </div>
              <!-- END User Dropdown -->

              <!-- Toggle Side Overlay -->
          </div>
          <!-- END Right Section -->
      </div>
      <!-- END Header Content -->

      <!-- Header Search -->
      <div
          id="page-header-search"
          class="overlay-header bg-body-extra-light"
      >
          <div class="content-header">
              <form class="w-100" method="POST">
                  <div class="input-group input-group-sm">
                      <!-- Layout API, functionality initialized in Template._uiApiLayout() -->
                      <button
                          type="button"
                          class="btn btn-danger"
                          data-toggle="layout"
                          data-action="header_search_off"
                      >
                          <i class="fa fa-fw fa-times-circle"></i>
                      </button>
                      <input
                          type="text"
                          class="form-control"
                          placeholder="Search or hit ESC.."
                          id="page-header-search-input"
                          name="page-header-search-input"
                      />
                  </div>
              </form>
          </div>
      </div>
      <!-- END Header Search -->

      <!-- Header Loader -->
      <!-- Please check out the Loaders page under Components category to see examples of showing/hiding it -->
      <div
          id="page-header-loader"
          class="overlay-header bg-body-extra-light"
      >
          <div class="content-header">
              <div class="w-100 text-center">
                  <i class="fa fa-fw fa-circle-notch fa-spin"></i>
              </div>
          </div>
      </div>
      <!-- END Header Loader -->
  </header>
  <!-- END Header -->

    <!-- Main Container -->
    <main id="main-container">
      @yield('content')
    </main>
    <!-- END Main Container -->

  <!-- Footer -->
  <footer id="page-footer" class="bg-body-light">
      <div class="content py-3">
          <div class="row fs-sm">
              <div
                  class="col-sm-6 order-sm-2 py-1 text-center text-sm-end"
              >
                  Crafted with
                  <i class="fa fa-heart text-danger"></i> by
                  <a
                      class="fw-semibold"
                      href="https://www.linkedin.com/in/satyadjv/"
                      target="_blank"
                      >putu satya saputra</a
                  >
              </div>
              <div
                  class="col-sm-6 order-sm-1 py-1 text-center text-sm-start"
              >
                  <a
                      class="fw-semibold"
                      href="https://akuntansi.pnb.ac.id"
                      target="_blank"
                      >Akuntansi PNB</a
                  >
                  &copy; <span data-toggle="year-copy"></span>
              </div>
          </div>
      </div>
  </footer>
  <!-- END Footer -->
</div>
  <!-- END Page Container -->
</body>

</html>
