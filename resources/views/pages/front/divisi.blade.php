@extends('layouts.front')

@section('title', 'Struktur Kabinet')

@section('content')
<div class="" style="background-image: url({{ URL::asset('assets/img/bg-banner.jpg') }}), linear-gradient(rgba(44, 70, 79, 0.9), rgba(44, 70, 79, 0.9)) ; background-size: cover; background-repeat: no-repeat; background-position: center; background-blend-mode: overlay;">
  <div class="container">
    <div class="row justify-content-center align-items-center">
        <div class="col-12 text-center text-white">
            <h3 class="text-uppercase text-white" style="margin: 100px 0 100px 0">Struktur Kabinet</h3>
        </div>
    </div>
  </div>
</div>

<div class="content my-5">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-10 mb-5">
        @if ($profiles->organization)
          <img class="mx-auto" src="{{ Storage::url($profiles->organization) }}" alt="Struktur Organisasi">
        @endif
      </div>
      <div class="col-md-12">
        <div class="row">
          @forelse ($divisi as $dv)
          <div class="col-md-4 mt-4">
            <div class="card p-3 text-center shadow border-0">
              <img src="{{ Storage::url($dv->foto) }}" class="mx-auto mb-2" style="width: 75%" alt="">
              <h3>{{ $dv->jabatan }}</h3>
              <span class="fw-normal fs-5">{{ $dv->name }}</span>
              <span class="fw-normal fs-5">{{ $dv->jurusan }}</span>
            </div>
          </div>
        @empty
          <div class="text-center">Belum ada data!</div>
        @endforelse
        </div>
      </div>
      
    </div>
  </div>
</div>
@endsection