<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <title>{{ $title ?? 'Task Management System' }}</title>

  <link rel="stylesheet" href="{{ asset('adminlte/plugins/fontawesome-free/css/all.min.css') }}">
  <link rel="stylesheet" href="{{ asset('adminlte/dist/css/adminlte.min.css') }}">
</head>

<body class="hold-transition sidebar-mini layout-fixed">
  <div class="wrapper">

    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
      <ul class="navbar-nav ml-auto">
        <li class="nav-item">
          <a href="{{ url('/logout') }}" class="nav-link">Logout</a>
        </li>
      </ul>
    </nav>

    <aside class="main-sidebar sidebar-dark-primary elevation-4">

      <a href="#" class="brand-link">
        <span class="brand-text font-weight-light">Task Manager</span>
      </a>

      <div class="sidebar">
        <nav class="mt-2">
          <ul class="nav nav-pills nav-sidebar flex-column">

            @if(auth()->user()->role == 'guru')
            <li class="nav-item">
              <a href="/guru/dashboard" class="nav-link">
                <i class="nav-icon fas fa-home"></i>
                <p>Dashboard </p>
              </a>
            </li>

            <li class="nav-item">
              <a href="{{ route('guru.profile') }}" class="nav-link">
                <i class="nav-icon fas fa-user"></i>
                <p>Profil Saya</p>
              </a>
            </li>

            <li class="nav-item">
              <a href="{{ route('guru.assignments') }}" class="nav-link">
                <i class="nav-icon fas fa-book"></i>
                <p>Kelola Tugas</p>
              </a>
            </li>
            @endif

            @if(auth()->user()->role == 'murid')
            <li class="nav-item">
              <a href="/murid/dashboard" class="nav-link">
                <i class="nav-icon fas fa-home"></i>
                <p>Dashboard</p>
              </a>
            </li>

            <li class="nav-item">
              <a href="/murid/profile" class="nav-link">
                <i class="nav-icon fas fa-user"></i>
                <p>Profil Saya</p>
              </a>
            </li>

            <li class="nav-item">
              <a href="/murid" class="nav-link">
                <i class="nav-icon fas fa-book"></i>
                <p>Daftar Tugas</p>
              </a>
            </li>

            <li class="nav-item">
              <a href="/murid/submissions" class="nav-link">
                <i class="nav-icon fas fa-check"></i>
                <p>Tugas Saya</p>
              </a>
            </li>
            @endif

          </ul>
        </nav>
      </div>

    </aside>

    <div class="content-wrapper p-4">
      @yield('content')
    </div>

  </div>

  <script src="{{ asset('adminlte/plugins/jquery/jquery.min.js') }}"></script>
  <script src="{{ asset('adminlte/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
  <script src="{{ asset('adminlte/dist/js/adminlte.min.js') }}"></script>

</body>

</html>