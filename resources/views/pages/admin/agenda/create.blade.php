@extends('layouts.admin')
@section('title', 'Agenda')

@section('content')
<!-- Main Content -->
<div class="main-content">
  <section class="section">
    <div class="section-header">
      <h1>Tambah Agenda</h1>
    </div>
    <a href="{{ route('agenda.index')}}" class="btn btn-icon icon-left btn-primary mb-4"><i class="fas fa-arrow-left"></i>Kembali</a>
      <div class="row">
      <div class="col-12 col-md-12 col-lg-12">
        <div class="card">
          <form action="{{ route('agenda.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
          <div class="card-body">          
            <div class="form-group">
              <label>Nama Kegiatan</label>
              <input type="text" name="name" class="form-control" value="{{ old('name') }}" required>
            </div>
            <div class="form-group">
              <label>Deskripsi</label>
              <textarea type="text" name="description" class="form-control" value="{{ old('description') }}" required></textarea>
            </div>
            <div class="form-group">
              <label>Alamat</label>
              <input type="text" name="address" class="form-control" value="{{ old('address') }}" required>
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