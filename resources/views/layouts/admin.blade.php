<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
  
  <title>@yield('title') | {{ getSiteName() }}</title>

  <!-- General CSS Files -->
  <link rel="stylesheet" href="{{ asset('assets/plugins/bootstrap/css/bootstrap.min.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/plugins/font-awesome/css/all.min.css') }}">

  <!-- Template CSS -->
  <link rel="stylesheet" href="{{ asset('assets/themes/stisla/css/style.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/themes/stisla/css/components.css') }}">

  @yield('custom_head')
</head>

<body>
  <div id="app">
    <div class="main-wrapper">
      <div class="navbar-bg"></div>
      <nav class="navbar navbar-expand-lg main-navbar">
        <form class="form-inline mr-auto">
          <ul class="navbar-nav mr-3">
            <li><a href="#" data-toggle="sidebar" class="nav-link nav-link-lg"><i class="fas fa-bars"></i></a></li>
            <li><a href="#" data-toggle="search" class="nav-link nav-link-lg d-sm-none"><i class="fas fa-search"></i></a></li>
          </ul>
        </form>
        <ul class="navbar-nav navbar-right">
          <li class="dropdown"><a href="#" data-toggle="dropdown" class="nav-link dropdown-toggle nav-link-lg nav-link-user">
            <img alt="image" src="{{ getAdminPicture() }}" class="rounded-circle mr-1">
            <div class="d-sm-none d-lg-inline-block">{{ Auth::user()->name }}</div></a>
            <div class="dropdown-menu dropdown-menu-right">
              <div class="dropdown-title">Halo</div>
              <a href="{{ route('admin.settings.profile') }}" class="dropdown-item has-icon">
                <i class="far fa-user"></i> Profil
              </a>
              <a href="{{ route('admin.settings') }}" class="dropdown-item has-icon">
                <i class="fas fa-cog"></i> Pengaturan
              </a>
              <div class="dropdown-divider"></div>
              <a href="#" class="dropdown-item has-icon text-danger" onclick="event.preventDefault();
                document.getElementById('logout-form').submit();">
                <i class="fas fa-sign-out-alt"></i> Logout
              </a>
            </div>
          </li>
        </ul>
      </nav>
      <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
        @csrf
      </form>

      <div class="main-sidebar">
        <aside id="sidebar-wrapper">
          <div class="sidebar-brand">
            <a href="{{ route('home') }}">{{ getSiteName() }}</a>
          </div>
          <div class="sidebar-brand sidebar-brand-sm">
            <a href="{{ route('home') }}">{{ createAcronym(getSiteName()) }}</a>
          </div>
          <ul class="sidebar-menu">
              <li class="menu-header">Welcome to Dashboard</li>
              <li class="nav-item{{ __active('AdminController', 'index') }}">
                <a href="{{ route('admin.home') }}" class="nav-link"><i class="fas fa-fire"></i><span>Dashboard</span></a>
              </li>
              <li class="menu-header">Sanggar Relasi</li>
              <li class="nav-item{{ __active('RelationController', ['index', 'show', 'edit']) }}">
                <a href="{{ route('relations.index') }}" class="nav-link"><i class="fas fa-home"></i> <span>Sanggar</span></a>
              </li>
              <li class="nav-item{{ __active('RelationController', 'create') }}">
                <a class="nav-link" href="{{ route('relations.create') }}"><i class="fas fa-plus"></i> <span>Tambah Sanggar Baru</span></a></li>
              
                <li class="menu-header">Edukasi</li>
                <li class="nav-item{{ __active('VideoController', 'index') }}">
                  <a class="nav-link" href="{{ route('admin.edu.videos')}}"><i class="fas fa-video"></i> <span>Video</span></a></li>
                  <li class="nav-item{{ __active('PhotoController') }}">
                    <a class="nav-link" href="{{ route('photos.index') }}"><i class="fas fa-images"></i> <span>Foto</span></a></li>
                    <li class="nav-item{{ __active(['ArticleController', 'CategoryController']) }}">
                      <a class="nav-link" href="{{ route('articles.index') }}"><i class="fas fa-newspaper"></i> <span>Artikel</span></a></li>
            
              <li class="menu-header">Pengaturan</li>
              <li class="nav-item{{ __active('SettingController', 'social_links') }}">
                <a href="{{ route('admin.settings.socials') }}" class="nav-link"><i class="fab fa-facebook"></i> <span>Sosial Media</span></a>
              </li>
              <li class="nav-item{{ __active('SettingController', 'sliders') }}">
                <a href="{{ route('admin.settings.sliders') }}" class="nav-link"><i class="far fa-images"></i> <span>Sliders</span></a>
              </li>
            </ul>

            <div class="mt-4 mb-4 p-3 hide-sidebar-mini">
              <a href="{{ route('home') }}" class="btn btn-primary btn-lg btn-block btn-icon-split">
                <i class="fas fa-rocket"></i> {{ getSiteName() }}
              </a>
            </div>
        </aside>
      </div>

      @yield('content')

      <footer class="main-footer">
        <div class="footer-left">
          Copyright &copy; 2020 {{ getSiteName() }}
        </div>
        <div class="footer-right">
          Stisla admin
        </div>
      </footer>
    </div>
  </div>

  @yield('custom_html')

  <!-- General JS Scripts -->
  <script src="{{ asset('assets/plugins/jquery/jquery-3.2.1.min.js') }}"></script>
  <script src="{{ asset('assets/plugins/bootstrap/js/popper.js') }}"></script>
  <script src="{{ asset('assets/plugins/bootstrap/js/bootstrap.min.js') }}"></script>
  <script src="{{ asset('assets/plugins/jquery.nicescroll/jquery.nicescroll.min.js') }}"></script>
  <script src="{{ asset('assets/themes/stisla//js/stisla.js') }}"></script>

  <!-- Template JS File -->
  <script src="{{ asset('assets/themes/stisla/js/scripts.js') }}"></script>

  @stack('custom_js')
</body>
</html>
