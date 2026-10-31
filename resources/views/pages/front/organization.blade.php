@extends('layouts.front')

@section('title', 'Struktur Organisasi')

@section('content')
<div class="" style="background-image: url({{ URL::asset('assets/img/desa.jpg') }}), linear-gradient(rgba(44, 70, 79, 0.9), rgba(44, 70, 79, 0.9)) ; background-size: cover; background-repeat: no-repeat; background-position: center; background-blend-mode: overlay;">
  <div class="container">
    <div class="row justify-content-center align-items-center">
        <div class="col-12 text-center text-white">
            <h3 class="text-uppercase text-white" style="margin: 100px 0 100px 0">Struktur Organisasi</h3>
        </div>
    </div>
  </div>
</div>

<div class="content my-5">
  <div class="container">
    <div class="row justify-content-center align-items-center">
      <div class="col-8">
        <div class="card shadow-lg">
          <img src="{{ Storage::url($company->organization) }}" width="100%" height="100%" alt="">
        </div>
      </div>
    </div>
  </div>
</div>
@endsection