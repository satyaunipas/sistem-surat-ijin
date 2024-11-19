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
  <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('media/favicons/pnb.png') }}">

  <!-- Modules -->
  @yield('css')
  @vite(['resources/sass/main.scss', 'resources/js/oneui/app.js'])
  @yield('js')
</head>

<body>
  <div id="page-container">
    <!-- Main Container -->
    <main id="main-container">
      @yield('content')
    </main>
    <!-- END Main Container -->
  </div>
  <!-- END Page Container -->
</body>

</html>
