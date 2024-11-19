<!doctype html>
<html lang="{{ config('app.locale') }}">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">

  <title>Electronic Letter for Student Absence</title>

  <meta name="description" content="Electronic Letter for Student AbsenceElectronic Letter for Student Absence">
  <meta name="author" content="pixelcave">
  <meta name="robots" content="noindex, nofollow">

  <!-- Icons -->
  <link rel="shortcut icon" href="{{ asset('media/favicons/pnb.png') }}">
  <link rel="icon" sizes="192x192" type="image/png" href="{{ asset('media/favicons/pnb.png') }}">
  <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('media/favicons/apple-touch-icon-180x180.png') }}">

  <!-- Modules -->
  @yield('css')
  @vite(['resources/sass/main.scss', 'resources/js/oneui/app.js'])

  <!-- Alternatively, you can also include a specific color theme after the main stylesheet to alter the default color theme of the template -->
  {{-- @vite(['resources/sass/main.scss', 'resources/sass/oneui/themes/amethyst.scss', 'resources/js/oneui/app.js']) --}}
  @yield('js')
</head>

<body>
  <div id="page-container" class="sidebar-dark page-header-fixed page-header-dark main-content-boxed">
    <!-- Header -->
    <header id="page-header">
                <!-- Header Content -->
                <div class="content-header">
                    <!-- Left Section -->
                    <div class="d-flex align-items-center">
                        <!-- Logo -->
                            @auth
                            <ul class="navbar-nav">
                                <li class="nav-item dropdown">
                                  <a class="nav-link dropdown-toggle" href="#" id="navbarDarkDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    Wellcome back, {{ auth()->user()->name }}
                                  </a>
                                  <ul class="dropdown-menu dropdown-menu-dark" aria-labelledby="navbarDarkDropdownMenuLink">
                                    <li>
                                        <a class="dropdown-item" 
                                           href="{{ auth()->user()->role == 'mahasiswa' ? '/mahasiswa/dashboard' : (auth()->user()->role == 'dosen' ? '/dosen/dashboard' : (auth()->user()->role == 'admin' ? '/admin/dashboard' : '/super_admin/dashboard')) }}">
                                           Dashboard
                                        </a>
                                    </li>
                                        <form action="/logout" method="POST">
                                            @csrf
                                          <button type="submit"
                                              class="dropdown-item"
                                          >
                                              <span class="fs-sm fw-medium"
                                                  >Log Out</span
                                              >
                                          </button>
                                        </form>
                                    </li>
                                  </ul>
                                </li>
                              </ul>
                            @else
                            <a
                                class="fw-semibold fs-5 tracking-wider text-dual me-3"
                                href="/login"
                            >
                                Login
                            </a>
                            @endauth
                        <!-- END Logo -->
                    </div>
                    <!-- END Left Section -->

                    <!-- Right Section -->
                    <div class="d-flex align-items-center">
                        <!-- Menu -->
                        <div class="d-none d-lg-block">
                            <ul
                                class="nav-main nav-main-horizontal nav-main-hover"
                            >
                                <li class="nav-main-item">
                                    <a
                                        class="nav-main-link active"
                                        href="/"
                                    >
                                        <i
                                            class="nav-main-link-icon si si-home"
                                        ></i>
                                        <span class="nav-main-link-name"
                                            >Home</span
                                        >
                                    </a>
                                </li>
                                <li class="nav-main-item">
                                    <a
                                        class="nav-main-link"
                                        href="#feature"
                                    >
                                        <i
                                            class="nav-main-link-icon si si-rocket"
                                        ></i>
                                        <span class="nav-main-link-name"
                                            >Features</span
                                        >
                                    </a>
                                </li>
                                <li class="nav-main-item">
                                    <a
                                        class="nav-main-link"
                                        href="#kontak"
                                    >
                                        <i
                                            class="nav-main-link-icon si si-envelope"
                                        ></i>
                                        <span class="nav-main-link-name"
                                            >Contact</span
                                        >
                                    </a>
                                </li>
                            </ul>
                        </div>
                        <!-- END Menu -->

                        <!-- Toggle Sidebar -->
                        <!-- Layout API, functionality initialized in Template._uiApiLayout() -->
                        <button
                            type="button"
                            class="btn btn-sm btn-alt-secondary d-lg-none ms-1"
                            data-toggle="layout"
                            data-action="sidebar_toggle"
                        >
                            <i class="fa fa-fw fa-bars"></i>
                        </button>
                        <!-- END Toggle Sidebar -->
                    </div>
                    <!-- END Right Section -->
                </div>
                <!-- END Header Content -->

                <!-- Header Search -->
                <div
                    id="page-header-search"
                    class="overlay-header bg-body-extra-light"
                >
                </div>
                <!-- END Header Search -->

                <!-- Header Loader -->
                <!-- Please check out the Loaders page under Components category to see examples of showing/hiding it -->
                <div
                    id="page-header-loader"
                    class="overlay-header bg-primary-lighter"
                >
                    <div class="content-header">
                        <div class="w-100 text-center">
                            <i
                                class="fa fa-fw fa-circle-notch fa-spin text-primary"
                            ></i>
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
    <footer id="page-footer" class="bg-body-extra-light">
                <div class="content py-4">
                    <!-- Footer Navigation -->
                    <div class="row items-push fs-sm border-bottom pt-4">
                        <div class="col-sm-6 col-md-4" id="kontak">
                            <h3>Follow Us</h3>
                            <ul class="list list-simple-mini">
                                <li>
                                    <a
                                        class="fw-semibold"
                                        href="https://www.pnb.ac.id/"
                                    >
                                        Politeknik Negeri Bali
                                    </a>
                                </li>
                                <li>
                                    <a
                                        class="fw-semibold"
                                        href="https://akuntansi.pnb.ac.id/"
                                    >
                                        Jurusan Akuntansi
                                    </a>
                                </li>
                                <li>
                                    <a
                                        class="fw-semibold"
                                        href="https://www.pnb.ac.id/prodi/d2-administrasi-perpajakan"
                                    >
                                        Program Studi D2 Administrasi Perpajakan
                                    </a>
                                </li>
                                <li>
                                    <a
                                        class="fw-semibold"
                                        href="https://www.pnb.ac.id/prodi/D3_akuntansi"
                                    >
                                        Program Studi D3 Akuntansi
                                    </a>
                                </li>
                                <li>
                                    <a
                                        class="fw-semibold"
                                        href="https://www.pnb.ac.id/prodi/D4_akuntansi_manajerial"
                                    >
                                        Program Studi D4 Akuntansi Manajerial
                                    </a>
                                </li>
                                <li>
                                    <a
                                        class="fw-semibold"
                                        href="https://www.pnb.ac.id/prodi/D4_akuntansi_perpajakan"
                                    >
                                        Program Studi D4 Akuntansi Perpajakan
                                    </a>
                                </li>
                            </ul>
                        </div>
                        <div class="col-sm-6 col-md-4">
                            <h3>Eksternal Link</h3>
                            <ul class="list list-simple-mini">
                                <li>
                                    <a
                                        class="fw-semibold"
                                        href="http://pkl-akuntansi.pnb.ac.id/"
                                    >
                                        Praktek Kerja Lapangan
                                    </a>
                                </li>
                                <li>
                                    <a
                                        class="fw-semibold"
                                        href="https://tracerstudy.pnb.ac.id/"
                                    >
                                        Tracer Study
                                    </a>
                                </li>
                                <li>
                                    <a
                                        class="fw-semibold"
                                        href="https://kerjasamacdc.pnb.ac.id/"
                                    >
                                        Lowongan kerja
                                    </a>
                                </li>
                                <li>
                                    <a
                                        class="fw-semibold"
                                        href="https://p3m.pnb.ac.id/"
                                    >
                                        P3M PNB
                                    </a>
                                </li>
                                <li>
                                    <a
                                        class="fw-semibold"
                                        href="https://elearning.pnb.ac.id/"
                                    >
                                        Elearning PNB
                                    </a>
                                </li>
                                <li>
                                    <a
                                        class="fw-semibold"
                                        href="https://dikti.kemdikbud.go.id/"
                                    >
                                        Kemenristekdikti
                                    </a>
                                </li>
                            </ul>
                        </div>
                        <div class="col-md-4">
                            <h3>Contact Us</h3>
                            <div class="fs-sm mb-4">
                                Jurusan Akuntansi<br />
                                Kampus Politeknik Negeri Bali,<br />
                                Bukit Jimbaran, Kuta Selatan, Badung-Bali<br />
                                <abbr title="Phone">Telp : </abbr> (0361) 701981<br />
                                <abbr title="Fax">Fax : </abbr> (0361) 701128
                            </div>
                            <h3>Subscribe to our news</h3>
                            <form class="push">
                                <div class="input-group">
                                    <input
                                        type="email"
                                        class="form-control form-control-alt"
                                        id="dm-gs-subscribe-email"
                                        name="dm-gs-subscribe-email"
                                        placeholder="Your email.."
                                    />
                                    <button
                                        type="submit"
                                        class="btn btn-alt-primary"
                                    >
                                        Subscribe
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <!-- END Footer Navigation -->

                    <!-- Footer Copyright -->
                    <div class="row fs-sm pt-4">
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
                                href="https://akuntansi.pnb.ac.id/"
                                target="_blank"
                                >Akuntansi PNB</a
                            >
                            &copy; <span data-toggle="year-copy"></span>
                        </div>
                    </div>
                    <!-- END Footer Copyright -->
                </div>
            </footer>
            <!-- END Footer -->
  </div>
  <!-- END Page Container -->
</body>

</html>
