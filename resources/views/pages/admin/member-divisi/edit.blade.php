@extends('layouts.admin')
@section('title', 'Divisi')

@section('content')
<!-- Main Content -->
<div class="main-content">
  <section class="section">
    <div class="section-header">
      <h1>Edit Anggota</h1>
    </div>
    <a href="{{ route('member-divisi.index')}}" class="btn btn-icon icon-left btn-primary mb-4"><i class="fas fa-arrow-left"></i>Kembali</a>
      <div class="row">
      <div class="col-12 col-md-12 col-lg-12">
        <div class="card">
          <form action="{{ route('member-divisi.update', $data->id) }}" method="POST" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="card-body">          
              <div class="form-row">
                <div class="form-group col-md-6">
                  <label>Nama</label>
                  <input type="text" name="name" class="form-control" value="{{ $data->name }}" required>
                </div>
                <div class="form-group col-md-6">
                  <label>Divisi</label>
                  <select class="form-control" name="divisi_id" id="exampleFormControlSelect1" required>
                    <option value="" disabled>Pilih Divisi</option>
                    @foreach ($divisi as $div)
                      <option value="{{ $div->id }}" {{ $div->id == $data->divisi_id ? 'selected' : '' }}>{{ $div->name }}</option>
                    @endforeach
                  </select>
                </div>
                <div class="form-group col-md-6">
                  <label>Periode</label>
                  <select class="form-control" name="period_id" required>
                    <option value="" disabled>Pilih Periode</option>
                    @foreach ($periode as $period)
                      <option value="{{ $period->id }}" {{ $period->id == $data->period_id ? 'selected' : '' }}>{{ $period->name }} ({{ $period->year_period }})</option>
                    @endforeach
                  </select>
                </div>
              </div>
              <div class="form-row">
                <div class="form-group col-md-6">
                  <label>Jabatan</label>
                  <input type="text" name="jabatan" class="form-control" value="{{ $data->position }}" required>
                </div>
                <div class="form-group col-md-6">
                  <label>Jurusan</label>
                  <input type="text" name="jurusan" class="form-control" value="{{ $data->jurusan }}" required>
                </div>
                <div class="form-group col-md-6">
                  <label>Foto</label>
                  <input type="file" name="foto" class="form-control" accept="image/*">
                  @if ($data->image)
                    <img src="{{ Storage::url($data->image) }}" alt="Foto anggota saat ini" class="mt-2" style="max-width: 120px;">
                  @endif
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