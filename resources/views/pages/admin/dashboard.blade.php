@extends('layouts.admin')
@section('title', 'Dashboard')

@section('content')
<div class="main-content">
  <section class="section">
    <div class="section-header">
      <h1>Dashboard</h1>
    </div>
    <div class="row">
      <div class="col-lg-3 col-md-6 col-sm-6 col-12">
        <div class="card card-statistic-1">
          <div class="card-icon bg-danger">
            <i class="fas fa-exclamation-triangle"></i>
          </div>
          <div class="card-wrap">
            <div class="card-header">
              <h4>Program Kerja Belum Terlaksana</h4>
            </div>
            <div class="card-body">
              {{ $prokerPending }}
            </div>
          </div>
        </div>
      </div>
      <div class="col-lg-3 col-md-6 col-sm-6 col-12">
        <div class="card card-statistic-1">
          <div class="card-icon bg-warning">
            <i class="fas fa-hourglass-half"></i>
          </div>
          <div class="card-wrap">
            <div class="card-header">
              <h4>Program Kerja Proses</h4>
            </div>
            <div class="card-body">
              {{ $prokerProcess }}
            </div>
          </div>
        </div>
      </div>
      <div class="col-lg-3 col-md-6 col-sm-6 col-12">
        <div class="card card-statistic-1">
          <div class="card-icon bg-success">
            <i class="far fa-file"></i>
          </div>
          <div class="card-wrap">
            <div class="card-header">
              <h4>Program Kerja Terlaksana</h4>
            </div>
            <div class="card-body">
              {{ $prokerSuccess }}
            </div>
          </div>
        </div>
      </div>
      <div class="col-lg-3 col-md-6 col-sm-6 col-12">
        <div class="card card-statistic-1">
          <div class="card-icon bg-info">
            <i class="fas fa-list"></i>
          </div>
          <div class="card-wrap">
            <div class="card-header">
              <h4>Total Kegiatan</h4>
            </div>
            <div class="card-body">
              {{ $totalKegiatan }}
            </div>
          </div>
        </div>
      </div>                  
    </div>

    <div class="row">
      <div class="col-lg-3 col-md-6 col-sm-6 col-12">
        <div class="card card-statistic-1">
          <div class="card-icon bg-primary">
            <i class="fas fa-th"></i>
          </div>
          <div class="card-wrap">
            <div class="card-header">
              <h4>Total Divisi</h4>
            </div>
            <div class="card-body">
              {{ $divisi }}
            </div>
          </div>
        </div>
      </div>
      <div class="col-lg-3 col-md-6 col-sm-6 col-12">
        <div class="card card-statistic-1">
          <div class="card-icon bg-info">
            <i class="fas fa-users"></i>
          </div>
          <div class="card-wrap">
            <div class="card-header">
              <h4>Total Pengurus</h4>
            </div>
            <div class="card-body">
              {{ $anggotaDivisi }}
            </div>
          </div>
        </div>
      </div>
      <div class="col-lg-3 col-md-6 col-sm-6 col-12">
        <div class="card card-statistic-1">
          <div class="card-icon bg-secondary">
            <i class="fas fa-user-cog"></i>
          </div>
          <div class="card-wrap">
            <div class="card-header">
              <h4>Total User</h4>
            </div>
            <div class="card-body">
              {{ $user }}
            </div>
          </div>
        </div>
      </div>
      <div class="col-lg-3 col-md-6 col-sm-6 col-12">
        <div class="card card-statistic-1">
          <div class="card-icon bg-dark">
            <i class="fas fa-newspaper"></i>
          </div>
          <div class="card-wrap">
            <div class="card-header">
              <h4>Total Artikel</h4>
            </div>
            <div class="card-body">
              {{ $news }}
            </div>
          </div>
        </div>
      </div>                  
    </div>
  </section>
</div>
@endsection