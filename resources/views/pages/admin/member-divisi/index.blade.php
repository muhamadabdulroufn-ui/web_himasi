@extends('layouts.admin')
@section('title', 'Anggota Divisi')

@section('content')
<!-- Main Content -->
<div class="main-content">
  <section class="section">
    <div class="section-header">
      <h1>Anggota Divisi</h1>
    </div>
    <div class="row">
      <div class="col">
        <a href="{{ route('member-divisi.create')}}" class="btn btn-icon icon-left btn-primary mb-4"><i class="fas fa-plus"></i>Tambah</a>
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
                      <th>Foto</th>
                      <th>Nama</th>
                      <th>Divisi</th>
                      <th>Jabatan</th>
                      <th>Jurusan</th>
                      <th>Aksi</th>
                  </tr>
              </thead>
              <tbody>
                <?php $no = 0;?>
                @forelse($data as $data)
                <tr>
                <td style="width:20px">{{ ++$no . "." }} </td>
                <td style="width:50px"><img src="{{ Storage::url($data->image) }}" class="img-thumbnail img-fluid img-responsive" alt="" style="width: 100%"></td>
                <td>{{ $data->name }}</td>
                <td>{{ $data->divisi->name }}</td>
                <td>{{ $data->position }}</td>
                <td>{{ $data->jurusan }}</td>
                <td class="d-flex">
                  <a href="{{ route('member-divisi.edit', $data->id) }} " class="btn btn-sm btn-warning mr-2" data-toggle="tooltip" data-placement="bottom" title="Edit">
                    <i class="fa fa-pencil-alt" ></i>
                  </a>
                  <form method="POST" action="{{ route('member-divisi.destroy', $data->id) }}">
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
            title: "Apakah Anda yakin ingin menghapus data ini?",
            text: "Data yang dihapus tidak dapat dikembalikan.",
            icon: "warning",
            type: "warning",
            buttons: ["Batal","Ya, hapus"],
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