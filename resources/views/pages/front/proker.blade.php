@extends('layouts.front')

@section('title', 'Program Kerja')

@section('content')
<div class="" style="background-image: url({{ URL::asset('assets/img/bg-banner.jpg') }}), linear-gradient(rgba(44, 70, 79, 0.9), rgba(44, 70, 79, 0.9)) ; background-size: cover; background-repeat: no-repeat; background-position: center; background-blend-mode: overlay;">
  <div class="container">
    <div class="row justify-content-center align-items-center">
        <div class="col-12 text-center text-white">
            <h3 class="text-uppercase text-white" style="margin: 100px 0 100px 0">Program Kerja</h3>
        </div>
    </div>
  </div>
</div>

<div class="content my-5">
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <div class="card-body p-0">
          <div class="table-responsive table-scroll" data-mdb-perfect-scrollbar="true" style="position: relative; height: 100%">
            <table class="table table-striped mb-0 table-bordered">
              <thead style="background-color: #32946a; color: white;">
                <tr>
                  <th scope="col">No</th>
                  <th scope="col">Periode</th>
                  <th scope="col">Divisi</th>
                  <th scope="col">Nama Program Kerja</th>
                  <th scope="col">Tanggal</th>
                  <th scope="col">Deskripsi</th>
                  <th scope="col">Status</th>
                </tr>
              </thead>
              <tbody>
                <?php $no = 0;?>
                @forelse ($proker as $proker)
                  <tr>
                    <td>{{ ++$no . "." }}</td>
                    <td>{{ $proker->periode->name }}</td>
                    <td>{{ $proker->divisi->name }}</td>
                    <td>{{ $proker->name }}</td>
                    <td>{{ \Carbon\Carbon::parse($proker->date)->format('d F Y') }}</td>
                    <td>{{ $proker->description }}</td>
                    <td> 
                      @if ($proker->status == 'belum_terlaksana')
                        <span class="badge bg-danger">Belum Terlaksana</span>
                      @elseif ($proker->status == 'proses') 
                        <span class="badge bg-warning">Proses</span>
                      @elseif ($proker->status == 'terlaksana')
                        <span class="badge bg-success">Terlaksana</span>
                      @endif
                    </td>
                  </tr>
                @empty
                  
                @endforelse
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection