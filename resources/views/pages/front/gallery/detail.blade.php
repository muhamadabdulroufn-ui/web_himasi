@extends('layouts.front')

@section('title', 'Detail Galeri')

@section('content')
<div class="" style="background-image: url({{ URL::asset('assets/img/bg-banner.jpg') }}), linear-gradient(rgba(44, 70, 79, 0.9), rgba(44, 70, 79, 0.9)) ; background-size: cover; background-repeat: no-repeat; background-position: center; background-blend-mode: overlay;">
  <div class="container">
    <div class="row justify-content-center align-items-center">
        <div class="col-12 text-center text-white">
            <h3 class="text-uppercase text-white" style="margin: 100px 0 100px 0">{{ $galleries->name }}</h3>
        </div>
    </div>
  </div>
</div>

<div class="content my-5">
  <div class="container">
    <div class="row align-items-center">
      @forelse ($galleries->detail_galeri as $gallery)
        <div class="col-md-4">
          <img src="{{ Storage::url($gallery->image) }}" alt="">
          <p class="text-center"><i>{{ $gallery->caption }}</i></p>
        </div>
      @empty
        <div class="text-center">Belum ada data!</div>
      @endforelse
    </div>
  </div>
</div>
@endsection