@extends('layouts.admin')
@section('title', 'Profil Organisasi')

@section('content')
<!-- Main Content -->
<div class="main-content">
  <section class="section">
    <div class="section-header">
      <h1>Profil Organisasi</h1>
    </div>
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <form action="{{ url('admin/profile', $data->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
          <div class="card-body">      
            <div class="form-row">
              <div class="form-group col-md-6">
                <label>Nama</label>
                <input type="text" name="name" class="form-control" value="{{ $data->name }}" required>
              </div>
              <div class="form-group col-md-6">
                <label>No. Telepon</label>
                <input type="number" name="telpon" class="form-control" value="{{ $data->telpon }}" required>
              </div>
            </div>
            <div class="form-row">
              <div class="form-group col-md-6">
                <label>Alamat</label>
                <input type="text" name="address" class="form-control" value="{{ $data->address }}" required>
              </div>
              <div class="form-group col-md-6">
                <label>Link Alamat <span>Gunakan link embed pada Google Maps</span></label>
                <input type="text" name="address_link" class="form-control" value="{{ $data->address_link }}" required>
              </div>
            </div>
            <div class="form-row">
              <div class="form-group col-md-6">
                <label>Email</label>
                <input type="email" name="email" class="form-control" value="{{ $data->email }}" required>
              </div>
              <div class="form-group col-md-6">
                <label>Logo</label>
                <input type="file" name="logo" class="form-control" accept="image/*">
                <small class="form-text text-muted">Logo ini digunakan pada navbar dan konten; ukurannya disesuaikan otomatis di navbar.</small>
              </div>
            </div>
            <div class="form-row">
              <div class="form-group col-md-6">
                <label>Visi</label>
                <textarea type="text" name="vision" class="form-control" value="{{ $data->vision }}" required>{{ $data->vision }}</textarea>
              </div>
              <div class="form-group col-md-6">
                <label>Misi</label>
                <textarea type="text" name="mission" class="form-control" value="{{ $data->mission }}" required>{{ $data->mission }}</textarea>
              </div>
            </div>
            <div class="form-row">
              <div class="form-group col-md-6">
                <label>Deskripsi Organisasi</label>
                <textarea type="text" name="description" class="form-control" value="{{ $data->description }}" required>{{ $data->description }}</textarea>
              </div>
              <div class="form-group col-md-3">
                <label>Struktur Organisasi</label>
                <input type="file" name="organization" class="form-control" value="{{ $data->organization }}">
              </div>
              <div class="form-group col-md-3">
                <label>Filosofi Logo</label>
                <input type="file" name="filosofi_logo" class="form-control" value="{{ $data->filosofi_logo }}">
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


@push('addon-script')
  <script>
    $('.show-alert-delete-box').click(function(event){
        var form =  $(this).closest("form");
        var name = $(this).data("name");
        event.preventDefault();
        swal({
            title: "Are you sure you want to delete this record?",
            text: "If you delete this, it will be gone forever.",
            icon: "warning",
            type: "warning",
            buttons: ["Cancel","Yes!"],
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
        }).then((willDelete) => {
            if (willDelete) {
                form.submit();
            }
        });
    });
  </script>
@endpush