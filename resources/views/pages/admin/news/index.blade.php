@extends('layouts.admin')
@section('title', 'Artikel')

@section('content')
<!-- Main Content -->
<div class="main-content">
  <section class="section">
    <div class="section-header">
      <h1>Artikel</h1>
    </div>
    <div class="row">
      <div class="col">
        <a href="{{ route('berita.create')}}" class="btn btn-icon icon-left btn-primary mb-4"><i class="fas fa-plus"></i>Tambah Artikel</a>
        <a href="{{ route('kategori-berita.index')}}" class="btn btn-icon icon-left btn-primary mb-4"><i class="fas fa-box"></i>Kategori Artikel</a>
      </div>
    </div>
    <div class="row">
      <div class="col-12 col-md-12 col-lg-12">
        <div class="card">
          <div class="card-body table-responsive-sm">
            <table id="book-table" class="table table-bordered" width="100%" collspacing="0">
              <thead>
                  <tr>
                     <th>No</th>
                      <th>Judul</th>
                      <th>Kategori</th>
                      <th>Penulis</th>
                      <th>Deskripsi (Isi)</th>
                      <th>Foto</th>
                      <th>Aksi</th>
                  </tr>
              </thead>
              <tbody>
                <?php $no = 0;?>
                @forelse($data as $data)
                <tr>
                <td>{{ ++$no . "." }} </td>
                <td>{{ $data->title }}</td>
                <td>{{ $data->category->name }}</td>
                <td>{{ $data->creator->name }}</td>
                <td>{!! \Illuminate\Support\Str::words($data->description, 30,'...') !!}</td>
                <td><img src="{{ Storage::url($data->image) }} " alt="" style="width: 100px" class="img-thumbnail"/></td>
                <td class="d-flex">
                  <a href="{{ route('berita.edit', $data->id) }} " class="btn btn-sm btn-warning mr-2" data-toggle="tooltip" data-placement="bottom" title="Edit">
                    <i class="fa fa-pencil-alt" ></i>
                  </a>
                  <form method="POST" action="{{ route('berita.destroy', $data->id) }}">
                    @csrf
                    <input name="_method" type="hidden" value="DELETE">
                    <button type="submit" class="btn btn-xs btn-danger btn-flat show-alert-delete-box btn-sm" data-toggle="tooltip" data-placement="bottom" title='Delete'><i class="fas fa-trash"></i></button>
                  </form>
                
                </td>
                </tr>
                @empty
                  <tr>
                      <td colspan="7" class="text-center">
                          Data Kosong
                      </td>
                  </tr>
                @endforelse
              </tbody>
            </table>
          </div>
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