@extends('layouts.admin')
@section('title', 'Kategori Artikel')

@section('content')
<!-- Main Content -->
<div class="main-content">
  <section class="section">
    <div class="section-header">
      <h1>Edit Kategori</h1>
    </div>
    <a href="{{ route('kategori-berita.index')}}" class="btn btn-icon icon-left btn-primary mb-4"><i class="fas fa-arrow-left"></i>Kembali</a>
      <div class="row">
      <div class="col-12 col-md-12 col-lg-12">
        <div class="card">
          <form action="{{ route('kategori-berita.update', $data->id) }}" method="POST" enctype="multipart/form-data">
            @method('PUT')
            @csrf
          <div class="card-body">          
            <div class="form-group">
              <label>Nama</label>
              <input type="text" name="name" class="form-control" value="{{ $data->name }}" required>
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