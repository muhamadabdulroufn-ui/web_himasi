@extends('layouts.admin')
@section('title', 'Galeri')

@section('content')
<!-- Main Content -->
<div class="main-content">
  <section class="section">
    <div class="section-header">
      <h1>Tambah Galeri</h1>
    </div>
    <a href="{{ route('galeri.index')}}" class="btn btn-icon icon-left btn-primary mb-4"><i class="fas fa-arrow-left"></i>Kembali</a>
      <div class="row">
      <div class="col-12 col-md-12 col-lg-12">
        <div class="card">
          <form action="{{ route('galeri.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
          <div class="card-body">          
            <div class="form-group">
              <label>Nama Kegiatan</label>
              <input type="text" name="name" class="form-control" value="{{ old('name') }}" required>
            </div>
            <div class="form-group">
              <label>Tanggal</label>
              <input type="date" name="date" class="form-control" value="{{ old('date') }}" required>
            </div>  
            <div class="form-group">
              <label>Thumbnail</label>
              <input type="file" name="thumbnail" class="form-control" value="{{ old('thumbnail') }}" required>
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