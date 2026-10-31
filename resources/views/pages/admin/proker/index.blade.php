@extends('layouts.admin')
@section('title', 'Program Kerja')

@section('content')
<!-- Main Content -->
<div class="main-content">
  <section class="section">
    <div class="section-header">
      <h1>Program Kerja</h1>
    </div>
    <div class="row">
      <div class="col">
        @if (Auth::user()->role != 'pembina')  
        <a href="{{ route('program-kerja.create')}}" class="btn btn-icon icon-left btn-primary mb-4"><i class="fas fa-plus"></i>Tambah Program Kerja</a>
        <a href="{{ route('periode.index')}}" class="btn btn-icon icon-left btn-primary mb-4"><i class="fas fa-box"></i>Periode</a>
        @endif
      </div>
    </div>
    <div class="row">
      <div class="col-12 col-md-12 col-lg-12">
        <div class="card">
          <div class="card-body table-responsive-sm">
            <table id="proker-table" class="table table-bordered" width="100%" collspacing="0">
              <thead>
                  <tr>
                      <th>No</th>
                      <th>Periode</th>
                      <th>Divisi</th>
                      <th>Nama</th>
                      <th>Tanggal</th>
                      <th>Status</th>
                      <th>Proposal</th>
                      <th>LPJ</th>
                      <th>Dokumentasi</th>
                      <th>Aksi</th>
                  </tr>
              </thead>
              <tbody>
                <?php $no = 0;?>
                @forelse($data as $data)
                <tr>
                <td>{{ ++$no . "." }}</td>
                <td>{{ $data->periode->name }} ({{ $data->periode->year_period }})</td>
                <td>{{ $data->divisi->name }}</td>
                <td>{{ $data->name }}</td>
                <td>{{ \Carbon\Carbon::parse($data->date)->format('d/m/Y') }}<br></td>
                <td>
                  @if ($data->status == 'belum_terlaksana')
                    <span class="badge badge-danger">Belum Terlaksana</span>
                  @elseif ($data->status == 'proses') 
                    <span class="badge badge-warning">Proses</span>
                  @elseif ($data->status == 'terlaksana')
                    <span class="badge badge-success">Terlaksana</span>
                  @endif
                </td>
                <td>
                  @if ($data->proposal == null)
                    -
                  @else
                    <a class="btn btn-info btn-sm" href="{{ Storage::url($data->proposal ) }}" download>Download</a>
                  @endif
                </td>
                <td>
                  @if ($data->lpj == null)
                    -
                  @else
                    <a class="btn btn-info btn-sm" href="{{ Storage::url($data->lpj ) }}" download>Download</a>
                  @endif
                </td>
                  
                <td style="width: 20px">
                  @if ($data->link_documentation == null)
                    -
                  @else
                    <a class="btn btn-info btn-sm" href="{{ $data->link_documentation }}" target="_blank">Lihat</a>
                  @endif
                </td>
                <td class="d-flex">
                  <a href="{{ route('program-kerja.show', $data->id) }} " class="btn btn-sm btn-primary mr-2" data-toggle="tooltip" data-placement="bottom" title="Detail">
                    <i class="fa fa-eye" ></i>
                  </a>
                  @if (Auth::user()->role == 'admin' || Auth::user()->role == 'pengurus')
                  <a href="{{ route('program-kerja.edit', $data->id) }} " class="btn btn-sm btn-warning mr-2" data-toggle="tooltip" data-placement="bottom" title="Edit">
                    <i class="fa fa-pencil-alt" ></i>
                  </a>
                  <form method="POST" action="{{ route('program-kerja.destroy', $data->id) }}">
                    @csrf
                    <input name="_method" type="hidden" value="DELETE">
                    <button type="submit" class="btn btn-xs btn-danger btn-flat show-alert-delete-box btn-sm" data-toggle="tooltip" data-placement="bottom" title='Delete'><i class="fas fa-trash"></i></button>
                  </form>
                  @endif
                </td>
                </tr>
                @empty
                  <tr>
                      <td colspan="9" class="text-center">
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

    $('#proker-table').dataTable();
  </script>
@endpush