@extends('layouts.front')

@section('title', 'Galeri')

@section('content')
<div class="" style="background-image: url({{ URL::asset('assets/img/bg-banner.jpg') }}), linear-gradient(rgba(44, 70, 79, 0.9), rgba(44, 70, 79, 0.9)) ; background-size: cover; background-repeat: no-repeat; background-position: center; background-blend-mode: overlay;">
  <div class="container">
    <div class="row justify-content-center align-items-center">
        <div class="col-12 text-center text-white">
            <h3 class="text-uppercase text-white" style="margin: 100px 0 100px 0">Galeri</h3>
        </div>
    </div>
  </div>
</div>

<div class="content my-5">
  <div class="container">
    <div class="row align-items-center">
      @forelse ($galleries as $gallery)
        <div class="col-md-4 mt-4">
          <div class="card p-3 text-center shadow border-0">
            <img src="{{ Storage::url($gallery->thumbnail) }}" class="mx-auto mb-4" alt="">
            <h5><a href="{{ url('galeri/'. $gallery->id.'/detail') }}">{{ $gallery->name }}</a></h5>
            <p class="text-center">
              {{ \Carbon\Carbon::parse($gallery->date)->format('d F Y') }}<br>
            </p>
          </div>
        </div>
      @empty
        <div class="text-center">Belum ada data!</div>
      @endforelse
    </div>
  </div>
</div>
@endsection