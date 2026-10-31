@extends('layouts.admin')
@section('title', 'Divisi')

@section('content')
<!-- Main Content -->
<div class="main-content">
  <section class="section">
    <div class="section-header">
      <h1>Tambah Anggota</h1>
    </div>
    <a href="{{ route('member-divisi.index')}}" class="btn btn-icon icon-left btn-primary mb-4"><i class="fas fa-arrow-left"></i>Kembali</a>
      <div class="row">
      <div class="col-12 col-md-12 col-lg-12">
        <div class="card">
          <form action="{{ route('member-divisi.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="card-body">          
              <div class="form-row">
                <div class="form-group col-md-6">
                  <label>Nama</label>
                  <input type="text" name="name" class="form-control" value="{{ old('name') }}" required>
                </div>
                <div class="form-group col-md-6">
                  <label>Divisi</label>
                  <select class="form-control" name="divisi_id" id="exampleFormControlSelect1" required>
                    <option value="" selected disabled>Pilih Divisi</option>
                    @foreach ($divisi as $div)
                      <option value="{{ $div->id }}">{{ $div->name }}</option>
                    @endforeach
                  </select>
                </div>
                <div class="form-group col-md-6">
                  <label>Periode</label>
                  <select class="form-control" name="period_id" required>
                    <option value="" selected disabled>Pilih Periode</option>
                    @foreach ($periode as $period)
                      <option value="{{ $period->id }}">{{ $period->name }} ({{ $period->year_period }})</option>
                    @endforeach
                  </select>
                </div>
              </div>
              <div class="form-row">
                <div class="form-group col-md-6">
                  <label>Jabatan</label>
                  <input type="text" name="jabatan" class="form-control" value="{{ old('jabatan') }}" required>
                </div>
                <div class="form-group col-md-6">
                  <label>Jurusan</label>
                  <input type="text" name="jurusan" class="form-control" value="{{ old('jurusan') }}" required>
                </div>
                <div class="form-group col-md-6">
                  <label>Foto</label>
                  <input type="file" name="foto" class="form-control" accept="image/*" required>
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