@extends('layouts.admin')
@section('title', 'Foto Latar Beranda')

@section('content')
<div class="main-content">
  <section class="section">
    <div class="section-header">
      <h1>Foto Latar Beranda</h1>
    </div>
    <div class="card">
      <div class="card-body">
        <p class="text-muted">Atur foto latar untuk tiga slide utama di halaman depan. Gambar yang tidak diganti akan tetap menggunakan foto saat ini.</p>
        <form action="{{ route('home-background.update') }}" method="POST" enctype="multipart/form-data">
          @csrf
          <div class="row">
            @foreach ([1, 2, 3] as $number)
              @php
                $field = 'home_background_' . $number;
                $fallback = asset('assets/img/bg-banner' . ($number === 1 ? '' : $number) . '.jpg');
                $preview = $profile->$field ? Storage::url($profile->$field) : $fallback;
              @endphp
              <div class="col-md-4 mb-4">
                <div class="border rounded p-3 h-100">
                  <label for="{{ $field }}" class="font-weight-bold">Foto Slide {{ $number }}</label>
                  <img src="{{ $preview }}" alt="Pratinjau foto slide {{ $number }}" class="img-fluid rounded mb-3" style="width: 100%; height: 190px; object-fit: cover;">
                  <input id="{{ $field }}" type="file" name="{{ $field }}" class="form-control" accept="image/*">
                  <small class="form-text text-muted">Format gambar, maksimal 10 MB.</small>
                  @error($field)
                    <small class="text-danger">{{ $message }}</small>
                  @enderror
                </div>
              </div>
            @endforeach
          </div>
          <button type="submit" class="btn btn-primary">Simpan Foto</button>
        </form>
      </div>
    </div>
  </section>
</div>
@endsection
