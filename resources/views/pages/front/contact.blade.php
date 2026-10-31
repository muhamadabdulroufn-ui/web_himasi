@extends('layouts.front')

@section('title', 'Kontak Kami')

@section('content')
<div class="" style="background-image: url({{ URL::asset('assets/img/bg-banner.jpg') }}), linear-gradient(rgba(44, 70, 79, 0.9), rgba(44, 70, 79, 0.9)) ; background-size: cover; background-repeat: no-repeat; background-position: center; background-blend-mode: overlay;">
  <div class="container">
    <div class="row justify-content-center align-items-center">
        <div class="col-12 text-center text-white">
            <h3 class="text-uppercase text-white" style="margin: 100px 0 100px 0">Kontak Kami</h3>
        </div>
    </div>
  </div>
</div>

<div class="content my-5">
  <div class="container">
    <div class="row justify-content-center align-items-center">
      <div class="col-md-6 text-center text-md-start mb-3 mb-md-0">
        <p class="mb-0 mt-0" style="font-size: 20px; line-height: 25pt;">
          {{ $profiles->name }}<br>
          No Telepon: {{ $profiles->telpon }}<br>
          Email: {{ $profiles->email }}<br>
          Alamat: {{ $profiles->address }}<br>
        </p>
      </div>
      <div class="col-md-6">
        {!! $profiles->address_link !!}
      </div>
    </div>
  </div>
</div>
@endsection