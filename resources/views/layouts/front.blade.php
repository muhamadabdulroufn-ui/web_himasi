<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    @if ($profiles->logo)
      <link rel="icon" href="{{ Storage::url($profiles->logo) }}">
    @else
      <link rel="icon" type="image/x-icon" href="{{ asset('assets/img/favicon.ico') }}">
    @endif

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/owl.theme.default.min.css') }}">
    <link href='https://unpkg.com/boxicons@2.1.1/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    @stack('addon-style')


    <title>@yield('title') | {{ $profiles->name }}</title>
</head>

<body data-bs-spy="scroll" data-bs-target=".navbar" data-bs-offset="70">


    <!-- TOP NAV -->
    <div class="top-nav" id="home">
        <div class="container">
            <div class="row justify-content-between">
                <div class="col-auto">
                    <p> <i class='bx bxs-envelope'></i> {{ $profiles->email }}</p>
                </div>
                <div class="col-auto social-icons">
                    <a href="https://www.youtube.com/channel/UCdVxJ2XlvZxsbNrb_zMw7fA" target="_blank"><i class='bx bxl-youtube'></i></a>
                    <a href="https://www.instagram.com/bemfebtd_unusa/" target="_blank"><i class='bx bxl-instagram'></i></a>
                    <a href="https://www.tiktok.com/@bemfebtdunusa" target="_blank"><i class='bx bxl-tiktok'></i></a>
                </div>
            </div>
        </div>
    </div>

    <!-- BOTTOM NAV -->
    <nav class="navbar navbar-expand-lg navbar-light bg-white sticky-top">
        <div class="container">
          <a href="/" class="navbar-brand">
            <!-- Logo Image -->
            @if ($profiles->logo)
              <img src="{{ Storage::url($profiles->logo) }}" alt="Logo {{ $profiles->name }}" class="navbar-brand-logo d-inline-block align-middle mr-2">
            @endif
            <!-- Logo Text -->
            <span class="text-uppercase font-weight-bold fs-5 d-none d-md-inline">{{ $profiles->name }}</span>
          </a>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse text-center" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                  <li class="nav-item">
                    <a class="nav-link" href="/">Home</a>
                  </li>
                  <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                      Profil
                    </a>
                    <ul class="dropdown-menu text-center text-md-start" aria-labelledby="navbarDropdown">
                      <li><a class="dropdown-item" href="/tentang">Tentang Kami</a></li>
                      <li><a class="dropdown-item" href="/divisi">Struktur Kabinet</a></li>
                    </ul>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="/program-kerja">Program Kerja</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="/artikel">Artikel</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="/agenda">Agenda</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="/galeri">Galeri</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="/kontak-kami">Kontak</a>
                  </li>
                </ul>
                @guest
                  <button class="btn btn-success nav-login-btn ms-lg-3" type="button" data-bs-toggle="modal" data-bs-target="#loginModal">Login</button>
                @endguest
          </div>
        </div>
    </nav>

    @guest
      <div class="modal fade" id="loginModal" tabindex="-1" aria-labelledby="loginModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
          <div class="modal-content login-modal">
            <div class="modal-header">
              <div>
                <h2 class="modal-title" id="loginModalLabel">Masuk ke akun</h2>
                <p class="mb-0">Masuk dengan username atau email dan kata sandi.</p>
              </div>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
            </div>
            <div class="modal-body">
              <form method="POST" action="{{ route('login') }}">
                @csrf

                <div class="mb-3">
                  <label for="modal-login" class="form-label">Username atau email</label>
                  <input id="modal-login" type="text" class="form-control @error('login') is-invalid @enderror"
                    name="login" value="{{ old('login') }}" required autocomplete="username" autofocus
                    placeholder="Username atau email">
                  @error('login')
                    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                  @enderror
                </div>

                <div class="mb-3">
                  <label for="modal-password" class="form-label">Kata sandi</label>
                  <div class="password-input-group">
                    <input id="modal-password" type="password" class="form-control @error('password') is-invalid @enderror"
                      name="password" required autocomplete="current-password" placeholder="Masukkan kata sandi">
                    <button class="password-toggle" type="button" data-toggle-password aria-controls="modal-password"
                      aria-label="Tampilkan kata sandi" aria-pressed="false">
                      <i class='bx bx-show' aria-hidden="true"></i>
                    </button>
                  </div>
                  @error('password')
                    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                  @enderror
                </div>

                <div class="form-check login-modal-remember mb-3">
                  <input class="form-check-input" type="checkbox" name="remember" id="modal-remember"
                    {{ old('remember') ? 'checked' : '' }}>
                  <label class="form-check-label fw-normal" for="modal-remember">Ingat saya</label>
                </div>

                <button type="submit" class="btn btn-success login-modal-submit">Masuk</button>
              </form>
            </div>
          </div>
        </div>
      </div>
    @endguest

    @yield('content')

    <footer>
        <div class="footer-top">
            <div class="container text-center text-md-start">
                <div class="row justify-content-start">
                    <div class="col-lg-5 mb-5 mb-lg-0">
                      <h4 class="navbar-brand">SEKILAS</h4>
                      <p>{{ \Illuminate\Support\Str::words($profiles->description, 35,'...'); }}</p>
                      <div class="col-auto social-icons">
                        <a href="https://www.youtube.com/channel/UCdVxJ2XlvZxsbNrb_zMw7fA" target="_blank"><i class='bx bxl-youtube'></i></a>
                        <a href="https://www.instagram.com/bemfebtd_unusa/" target="_blank"><i class='bx bxl-instagram'></i></a>
                        <a href="https://www.tiktok.com/@bemfebtdunusa" target="_blank"><i class='bx bxl-tiktok'></i></a>
                      </div>
                    </div>
                    <div class="col-lg-2 mb-5 mb-lg-0">
                      <h4 class="navbar-brand">AKSES CEPAT</h4>
                      <ul class="" style="padding: 0 !important; list-style-type:none">
                        <li><a href="{{ url('tentang') }}" style="color: white !important; text-decoration:none">Tentang</a></li>
                        <li><a href="{{ url('divisi') }}" style="color: white !important; text-decoration:none">Struktur Kabinet</a></li>
                        <li><a href="{{ url('program-kerja') }}" style="color: white !important; text-decoration:none">Program Kerja</a></li>
                        <li><a href="{{ url('artikel') }}" style="color: white !important; text-decoration:none">Artikel</a></li>
                        <li><a href="{{ url('agenda') }}" style="color: white !important; text-decoration:none">Agenda</a></li>
                        <li><a href="{{ url('galeri') }}" style="color: white !important; text-decoration:none">Galeri</a></li>
                        <li><a href="{{ url('login') }}" style="color: white !important; text-decoration:none">Login</a></li>
                      </ul>
                    </div>
                    <div class="col-lg-5">
                      <h4 class="navbar-brand">KONTAK KAMI</h4>
                      <div class="mt-4 footer-contact">
                        <h5 class="text-white"><i class="mdi mdi-map-marker mdi-24px color-primary"></i> Alamat</h5>
                        <p>{{ $profiles->address }}</p>
                        <h5 class="text-white"><i class="mdi mdi-phone mdi-24px color-primary"></i> No. Telp</h5>
                        <p>{{ $profiles->telpon }}</p>
                        <h5 class="text-white"><i class="mdi mdi-email-open mdi-24px color-primary"></i> Email</h5>
                        <p>{{ $profiles->email }}</p>
                    </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="footer-bottom text-center">
            <p class="mb-0">&copy; Copyright {{ $profiles->name }} {{ now()->year }} | All rights Reserved</p>
        </div>
    </footer>


    @stack('addon-script')
    <script src="{{ asset('assets/js/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/js/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('assets/js/app.js') }}"></script>
    <script>
      document.addEventListener('click', function (event) {
        var toggle = event.target.closest('[data-toggle-password]');
        if (!toggle) {
          return;
        }

        var input = document.getElementById(toggle.getAttribute('aria-controls'));
        var icon = toggle.querySelector('i');
        if (!input || !icon) {
          return;
        }

        var showPassword = input.type === 'password';
        input.type = showPassword ? 'text' : 'password';
        toggle.setAttribute('aria-label', showPassword ? 'Sembunyikan kata sandi' : 'Tampilkan kata sandi');
        toggle.setAttribute('aria-pressed', showPassword ? 'true' : 'false');
        icon.classList.toggle('bx-show', !showPassword);
        icon.classList.toggle('bx-hide', showPassword);
      });
    </script>
    @guest
      @if (session('openLoginModal') || $errors->has('login') || $errors->has('password'))
        <script>
          document.addEventListener('DOMContentLoaded', function () {
            var loginModal = document.getElementById('loginModal');
            if (loginModal && window.bootstrap) {
              bootstrap.Modal.getOrCreateInstance(loginModal).show();
            }
          });
        </script>
      @endif
    @endguest

</body>
</html>