@extends('layouts.admin')
@section('title', 'Detail Galeri')

@section('content')
<!-- Main Content -->
<div class="main-content">
  <section class="section">
    <div class="section-header">
      <h1>Edit Foto</h1>
    </div>
    <a href="{{ url('admin/detail-galeri/'.$data->id)}}" class="btn btn-icon icon-left btn-primary mb-4"><i class="fas fa-arrow-left"></i>Kembali</a>
      <div class="row">
      <div class="col-12 col-md-12 col-lg-12">
        <div class="card">
          <form action="{{ url('admin/detail-galeri/'.$data->id.'/'.$image->id.'/edit')}}" method="POST" enctype="multipart/form-data">
            @method('PUT')
            @csrf
          <div class="card-body">          
            <div class="form-group">
              <label>Caption</label>
              <input type="text" name="caption" class="form-control" value="{{ $image->caption }}" required>
            </div>
            <div class="form-group">
              <label>Foto</label>
              <input type="file" name="image" class="form-control">
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