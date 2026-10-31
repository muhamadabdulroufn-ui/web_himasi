@extends('layouts.admin')
@section('title', 'Artikel')

@section('content')
<!-- Main Content -->
<div class="main-content">
  <section class="section">
    <div class="section-header">
      <h1>Edit Artikel</h1>
    </div>
    <a href="{{ route('berita.index')}}" class="btn btn-icon icon-left btn-primary mb-4"><i class="fas fa-arrow-left"></i>Kembali</a>
      <div class="row">
      <div class="col-12 col-md-12 col-lg-12">
        <div class="card">
          <form action="{{ route('berita.update', $data->id) }}" method="POST" enctype="multipart/form-data">
            @method('PUT')
            @csrf
          <div class="card-body">          
            <div class="form-group">
              <label>Judul</label>
              <input type="text" name="title" class="form-control" value="{{ $data->title }}" required>
            </div>
            <div class="form-group">
              <label>Kategori</label>
              <select class="form-control" name="category_id" id="exampleFormControlSelect1">
                @foreach ($category as $cat)
                <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                @endforeach
              </select>
            </div>
            <div class="form-group">
              <label>Deskripsi (Isi)</label>
              <textarea type="text" name="description" class="form-control summernote" value="{{ old('description') }}" required>{{ $data->description }}</textarea>
            </div>
            <div class="form-group">
              <label>Foto</label>
              <input type="file" name="image" class="form-control" value="{{ $data->image }}">
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