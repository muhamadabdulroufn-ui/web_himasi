@extends('layouts.front')

@section('title', 'Tentang')

@section('content')
<div class="" style="background-image: url({{ URL::asset('assets/img/bg-banner.jpg') }}), linear-gradient(rgba(44, 70, 79, 0.9), rgba(44, 70, 79, 0.9)) ; background-size: cover; background-repeat: no-repeat; background-position: center; background-blend-mode: overlay;">
  <div class="container">
    <div class="row justify-content-center align-items-center">
        <div class="col-12 text-center text-white">
            <h3 class="text-uppercase text-white" style="margin: 100px 0 100px 0">Tentang</h3>
        </div>
    </div>
  </div>
</div>

<div class="content my-5">
  <div class="container">
    <div class="row justify-content-center align-items-center">
      <div class="col-12">
        <div class="card shadow-lg p-4 p-md-5 text-center border-0">
          @if ($profiles->logo)
            <img class="mx-auto mb-4" src="{{ Storage::url($profiles->logo) }}" alt="Logo {{ $profiles->name }}" style="width: 20%">
          @endif
          <h3>{{ $profiles->name }}</h3>
          <p class="mt-0">{{ $profiles->description }}</p>
          
          <div class="row mt-4 mb-4">
            <div class="col-md-6">
              <h4>VISI</h4>
              <p>{{ $profiles->vision }}</p>
            </div>
            <div class="col-md-6">
              <h4>MISI</h4>
              <p>{{ $profiles->mission }}</p>
            </div>
          </div>
          <h4>FILOSOFI LOGO {{ $profiles->name }}</h4>
          @if ($profiles->filosofi_logo)
            <img class="mx-auto mb-4" src="{{ Storage::url($profiles->filosofi_logo) }}" style="width: 80%">
          @endif
        </div>
      </div>
    </div>
  </div>
</div>
@endsection