@extends('layouts.admin')
@section('title', 'Program Kerja')

@section('content')
<!-- Main Content -->
<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Tambah Komentar</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="{{ route('addComment', $data->id) }}" method="POST">
        @csrf
        <div class="modal-body">
          <div class="form-group">
            <label>Komentar</label>
            <input type="hidden" name="proker_id" value="{{ $data->id }}">
            <div class="input-group">
              <textarea type="text" class="form-control" name="comment" required></textarea>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
          <button type="submit" class="btn btn-primary">Simpan</button>
        </div>
      </form>

    </div>
  </div>
</div>
<div class="main-content">
  <section class="section">
    <div class="section-header">
      <h1>Detail</h1>
    </div>
    <a href="{{ route('program-kerja.index')}}" class="btn btn-icon icon-left btn-primary mb-4"><i class="fas fa-arrow-left"></i>Kembali</a>
    <div class="row">
      <div class="col-12 col-md-12 col-lg-12">
        <div class="card">
          <div class="card-header">
            <h4>Detail Program Kerja</h5>
          </div>
          <div class="card-body">
            <div class="row mb-2">
              <div class="col-md-5">
                <h6 class="">Nama Program: <span class="font-weight-normal">{{ $data->name }}</span></h6>
                <h6 class="">Tanggal: <span class="font-weight-normal">{{ $data->date }}</span></h6>
                <h6 class="">Periode: <span class="font-weight-normal">{{ $data->periode->name }} ({{ $data->periode->year_period }})</span></h6>
                <h6 class="">Divisi: <span class="font-weight-normal">{{ $data->divisi->name }}</span></h6>
                @if ($data->status == 'belum_terlaksana')
                  <h6 class="">Status: <span class="badge badge-danger">Belum Terlaksana</span></h6>
                @elseif ($data->status == 'proses') 
                  <h6 class="">Status: <span class="badge badge-warning">Proses</span></h6>
                @elseif ($data->status == 'terlaksana')
                  <h6 class="">Status: <span class="badge badge-success">Terlaksana</span></h6>
                @endif
                <h6 class="">Deskripsi: <span class="font-weight-normal">{{ $data->description }}</span></h6>
              </div>
              <div class="col-md-5">
                <h6 class="">Proposal: <a href="{{ $data->proposal }}" download>Download</a></h6>
                <h6 class="">LPJ: <a href="{{ $data->lpj }}" download>Download</a></h6>
                <h6 class="">Dokumentasi: <a href="{{ $data->link_documentation }}">Lihat</a></h6>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-12 col-md-12 col-lg-12">
        <div class="card">
          <div class="card-header">
            <h4>Komentar</h4>
            <div class="card-header-action">
              <button type="button" class="btn btn-info" data-toggle="modal" data-target="#exampleModal">
                Tambah Komentar
              </button>
            </div>
          </div>
          <div class="card-body">
            <ul class="list-unstyled list-unstyled-border">
              @forelse ($data->comment as $comment) 
                <li class="media">
                  <div class="media-body">
                    <div class="mt-0 mb-1 font-weight-bold">{{ optional($comment->user)->name ?? 'Pengguna' }}</div>
                    <div class="text-muted font-600-bold">{{ $comment->comment }}</div>
                  </div>
                </li>
              @empty
              <span>Tidak ada komentar</span>
              @endforelse
            </ul>
          </div>
        </div>
      </div>
    </div>
  </section>
</div>
@endsection