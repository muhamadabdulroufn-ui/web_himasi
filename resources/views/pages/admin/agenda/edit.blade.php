@extends('layouts.admin')
@section('title', 'Agenda')

@section('content')
<!-- Main Content -->
<div class="main-content">
  <section class="section">
    <div class="section-header">
      <h1>Edit Agenda</h1>
    </div>
    <a href="{{ route('agenda.index')}}" class="btn btn-icon icon-left btn-primary mb-4"><i class="fas fa-arrow-left"></i>Kembali</a>
      <div class="row">
      <div class="col-12 col-md-12 col-lg-12">
        <div class="card">
          <form action="{{ route('agenda.update', $data->id) }}" method="POST" enctype="multipart/form-data">
            @method('PUT')
            @csrf
          <div class="card-body">          
            <div class="form-group">
              <label>Nama Kegiatan</label>
              <input type="text" name="name" class="form-control" value="{{ $data->name }}" required>
            </div>
            <div class="form-group">
              <label>Deskripsi</label>
              <textarea type="text" name="description" class="form-control" value="{{ old('description') }}" required>{{ $data->description }}</textarea>
            </div>
            <div class="form-group">
              <label>Alamat</label>
              <input type="text" name="address" class="form-control" value="{{ $data->address }}" required>
            </div>
            <div class="form-group">
              <label>Tanggal</label>
              <input type="date" name="date" class="form-control" value="{{ $data->date }}" required>
            </div>
            <div class="form-group">
              <label>Thumbnail</label>
              <input type="file" name="thumbnail" class="form-control" value="{{ $data->thumbnail }}">
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