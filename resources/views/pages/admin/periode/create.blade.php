@extends('layouts.admin')
@section('title', 'Periode')

@section('content')
<!-- Main Content -->
<div class="main-content">
  <section class="section">
    <div class="section-header">
      <h1>Tambah Periode</h1>
    </div>
    <a href="{{ route('periode.index')}}" class="btn btn-icon icon-left btn-primary mb-4"><i class="fas fa-arrow-left"></i>Kembali</a>
      <div class="row">
      <div class="col-12 col-md-12 col-lg-12">
        <div class="card">
          <form action="{{ route('periode.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
          <div class="card-body">          
            <div class="form-group">
              <label>Nama Kabinet</label>
              <input type="text" name="name" class="form-control" value="{{ old('name') }}" placeholder="Contoh: Kabinet Aksara" required>
              @error('name')
                <small class="text-danger">{{ $message }}</small>
              @enderror
            </div>
            <div class="form-group">
              <label>Tahun Periode</label>
              <input type="text" name="year_period" class="form-control" value="{{ old('year_period') }}" placeholder="Contoh: 2026-2027" required>
              @error('year_period')
                <small class="text-danger">{{ $message }}</small>
              @enderror
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