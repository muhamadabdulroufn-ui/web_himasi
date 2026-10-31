@extends('layouts.front')

@section('title', 'Login')

@push('addon-style')
    <style>
        .login-page {
            min-height: 620px;
            padding: 72px 16px;
            background: #f4f7f5;
        }

        .login-card {
            max-width: 960px;
            min-height: 440px;
            margin: 0 auto;
            overflow: hidden;
            border: 1px solid rgba(9, 50, 34, 0.08);
            border-radius: 12px;
            background: #fff;
            box-shadow: 0 18px 48px rgba(9, 50, 34, 0.09);
        }

        .login-intro {
            position: relative;
            display: flex;
            min-height: 440px;
            flex-direction: column;
            justify-content: space-between;
            overflow: hidden;
            padding: 48px;
            background: #0c3b2d;
            color: #fff;
        }

        .login-intro::after {
            position: absolute;
            right: -100px;
            bottom: -155px;
            width: 330px;
            height: 330px;
            border: 1px solid rgba(255, 255, 255, 0.12);
            border-radius: 50%;
            content: "";
        }

        .login-brand {
            position: relative;
            z-index: 1;
            display: flex;
            align-items: center;
            gap: 12px;
            color: #fff;
            font-size: 15px;
            font-weight: 700;
            letter-spacing: 0.04em;
        }

        .login-brand-mark {
            display: grid;
            width: 38px;
            height: 38px;
            place-items: center;
            border: 1px solid rgba(255, 255, 255, 0.28);
            border-radius: 9px;
            color: #a9e3ce;
            font-size: 20px;
        }

        .login-intro-copy {
            position: relative;
            z-index: 1;
            max-width: 330px;
            margin: 48px 0;
        }

        .login-intro-copy h1 {
            margin-bottom: 16px;
            color: #fff;
            font-size: clamp(30px, 4vw, 42px);
            font-weight: 600;
            letter-spacing: -0.02em;
            line-height: 1.18;
        }

        .login-intro-copy p,
        .login-intro-note {
            color: rgba(255, 255, 255, 0.76);
        }

        .login-intro-note {
            position: relative;
            z-index: 1;
            margin: 0;
            font-size: 13px;
        }

        .login-form-panel {
            display: flex;
            min-height: 440px;
            align-items: center;
            padding: 48px clamp(28px, 5vw, 68px);
        }

        .login-form-content {
            width: 100%;
            max-width: 370px;
            margin: 0 auto;
        }

        .login-form-content h2 {
            margin-bottom: 8px;
            color: #173c30;
            font-size: 28px;
            font-weight: 600;
            letter-spacing: -0.02em;
        }

        .login-form-content .login-subtitle {
            margin-bottom: 30px;
            color: #718078;
        }

        .login-form-content label {
            margin-bottom: 8px;
            color: #27483b;
            font-size: 14px;
            font-weight: 600;
        }

        .login-form-content .form-control {
            height: 48px;
            border: 1px solid #dfe7e2;
            border-radius: 6px;
            background: #fff;
            color: #173c30;
        }

        .login-form-content .form-control:focus {
            border-color: #37b091;
            box-shadow: 0 0 0 3px rgba(55, 176, 145, 0.13);
        }

        .login-remember {
            color: #64736b;
            font-size: 14px;
        }

        .login-remember .form-check-input:checked {
            border-color: #21865e;
            background-color: #21865e;
        }

        .login-submit {
            width: 100%;
            min-height: 48px;
            margin-top: 8px;
            border: 0;
            border-radius: 6px;
            background: #21865e;
            font-weight: 600;
        }

        .login-submit:hover,
        .login-submit:focus {
            background: #176f4c;
        }

        .login-back {
            display: inline-block;
            margin-top: 22px;
            color: #587267;
            font-size: 14px;
            text-decoration: none;
        }

        .login-back:hover {
            color: #21865e;
        }

        @media (max-width: 767.98px) {
            .login-page {
                min-height: auto;
                padding: 32px 14px;
            }

            .login-card {
                min-height: auto;
            }

            .login-intro {
                min-height: 230px;
                padding: 28px;
            }

            .login-intro-copy {
                margin: 32px 0 20px;
            }

            .login-intro-copy h1 {
                font-size: 30px;
            }

            .login-form-panel {
                min-height: auto;
                padding: 36px 26px 40px;
            }
        }
    </style>
@endpush

@section('content')
<main class="login-page">
    <div class="login-card row g-0">
        <section class="col-md-5 login-intro" aria-label="Informasi portal">
            <a href="{{ url('/') }}" class="login-brand text-decoration-none">
                <span class="login-brand-mark"><i class='bx bx-leaf' aria-hidden="true"></i></span>
                <span>HIMASI UNUSA</span>
            </a>

            <div class="login-intro-copy">
                <h1>Ruang kerja pengurus.</h1>
                <p>Masuk untuk mengelola informasi, kegiatan, dan konten HIMASI UNUSA.</p>
            </div>

            <p class="login-intro-note">Portal resmi pengelolaan organisasi</p>
        </section>

        <section class="col-md-7 login-form-panel" aria-labelledby="login-heading">
            <div class="login-form-content">
                <h2 id="login-heading">Masuk ke akun</h2>
                <p class="login-subtitle">Masuk dengan username atau email dan kata sandi.</p>

                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    <div class="mb-3">
                        <label for="login" class="form-label">Username atau email</label>
                        <input id="login" type="text" class="form-control @error('login') is-invalid @enderror"
                            name="login" value="{{ old('login') }}" required autocomplete="username" autofocus
                            placeholder="Username atau email">

                        @error('login')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="password" class="form-label">Kata sandi</label>
                        <div class="password-input-group">
                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror"
                                name="password" required autocomplete="current-password" placeholder="Masukkan kata sandi">
                            <button class="password-toggle" type="button" data-toggle-password aria-controls="password"
                                aria-label="Tampilkan kata sandi" aria-pressed="false">
                                <i class='bx bx-show' aria-hidden="true"></i>
                            </button>
                        </div>

                        @error('password')
                            <span class="invalid-feedback d-block" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="form-check login-remember mb-3">
                        <input class="form-check-input" type="checkbox" name="remember" id="remember"
                            {{ old('remember') ? 'checked' : '' }}>
                        <label class="form-check-label fw-normal" for="remember">Ingat saya</label>
                    </div>

                    <button type="submit" class="btn btn-success login-submit">Masuk</button>
                </form>

                <a class="login-back" href="{{ url('/') }}"><i class='bx bx-arrow-back' aria-hidden="true"></i> Kembali ke beranda</a>
            </div>
        </section>
    </div>
</main>
@endsection
