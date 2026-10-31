@extends('layouts.admin')
@section('title', 'Program Kerja')

@section('content')
<!-- Main Content -->
<div class="main-content">
  <section class="section">
    <div class="section-header">
      <h1>Edit Program Kerja</h1>
    </div>
    <a href="{{ route('program-kerja.index')}}" class="btn btn-icon icon-left btn-primary mb-4"><i class="fas fa-arrow-left"></i>Kembali</a>
    <div class="row">
      <div class="col-12 col-md-12 col-lg-12">
        <div class="card">
          <form action="{{ route('program-kerja.update', $data->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="card-body">          
              <div class="form-row">
                <div class="form-group col-md-6">
                  <label>Nama</label>
                  <input type="text" name="name" class="form-control" value="{{ $data->name }}" required>
                </div>
                <div class="form-group col-md-6">
                  <label>Tanggal</label>
                  <input type="date" name="date" class="form-control" value="{{ $data->date }}" required>
                </div>
              </div>

              <div class="form-row">
                <div class="form-group col-md-6">
                  <label>Divisi</label>
                  <select class="form-control" name="divisi_id" id="exampleFormControlSelect1" required>
                    <option selected disabled>Pilih Divisi</option>
                    @foreach ($divisi as $divisi)
                      <option value="{{ $divisi->id }}" {{ $divisi->id == $data->divisi_id ? 'selected' : '' }}>{{ $divisi->name }}</option>
                    @endforeach
                  </select>
                </div>
                <div class="form-group col-md-6">
                  <label>Status</label>
                  <select class="form-control" name="status" id="exampleFormControlSelect1">
                    <option value="belum_terlaksana" {{ $data->status == 'belum_terlaksana' ? 'selected' : '' }}>Belum Terlaksana</option>
                    <option value="proses" {{ $data->status == 'proses' ? 'selected' : '' }}>Proses</option>
                    <option value="terlaksana" {{ $data->status == 'terlaksana' ? 'selected' : '' }}>Terlaksana</option>
                  </select>
                </div>
              </div>

              <div class="form-row">
                <div class="form-group col-md-6">
                  <label>Periode</label>
                  <select class="form-control" name="periode_id" id="exampleFormControlSelect1" required>
                    <option selected disabled>Pilih Periode</option>
                    @foreach ($periode as $periode)
                      <option value="{{ $periode->id }}" {{ $periode->id == $data->periode_id ? 'selected' : '' }}>{{ $periode->name }} ({{ $periode->year_period }})</option>
                    @endforeach
                  </select>
                </div>
                <div class="form-group col-md-6">
                  <label>Proposal</label>
                  <input type="file" name="proposal" class="form-control">
                </div>
              </div>

              <div class="form-row">
                <div class="form-group col-md-6">
                  <label>LPJ</label>
                  <input type="file" name="lpj" class="form-control">
                </div>
                <div class="form-group col-md-6">
                  <label>Link Dokumentasi</label>
                  <input type="link" name="link_documentation" class="form-control" value="{{ $data->link_documentation }}">
                </div>
              </div>

              <div class="form-row">
                <div class="form-group col-md-6">
                  <label>Deskripsi</label>
                  <textarea type="text" name="description" class="form-control" value="{{ old('description') }}">{{ $data->description }}</textarea>
                </div>
              </div>
              <button type="submit" class="btn btn-icon icon-left btn-primary">
                Simpan
              </button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </section>
</div>
@endsection