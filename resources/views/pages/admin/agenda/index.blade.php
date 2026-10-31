@extends('layouts.admin')
@section('title', 'Agenda')

@section('content')
<!-- Main Content -->
<div class="main-content">
  <section class="section">
    <div class="section-header">
      <h1>Agenda</h1>
    </div>
    <div class="row">
      <div class="col">
        <a href="{{ route('agenda.create')}}" class="btn btn-icon icon-left btn-primary mb-4"><i class="fas fa-plus"></i>Tambah</a>
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
                      <th>Thumbnail</th>
                      <th>Nama Kegiatan</th>
                      <th>Deskripsi</th>
                      <th>Alamat</th>
                      <th>Tanggal</th>
                      <th>Aksi</th>
                  </tr>
              </thead>
              <tbody>
                <?php $no = 0;?>
                @forelse($data as $data)
                <tr>
                <td>{{ ++$no . "." }} </td>
                <td style="width:50px"><img src="{{ Storage::url($data->thumbnail) }}" class="img-thumbnail img-fluid img-responsive" alt="" style="width: 100%"></td>
                <td>{{ $data->name }}</td>
                <td>{{ \Illuminate\Support\Str::words($data->description, 30,'...') }}</td>
                <td>{{ $data->address }}</td>
                <td>{{ \Carbon\Carbon::parse($data->date)->format('d/m/Y') }}</td>
                <td class="d-flex">
                  <a href="{{ route('agenda.edit', $data->id) }} " class="btn btn-sm btn-warning mr-2" data-toggle="tooltip" data-placement="bottom" title="Edit">
                    <i class="fa fa-pencil-alt" ></i>
                  </a>
                  <form method="POST" action="{{ route('agenda.destroy', $data->id) }}">
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
  <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels@0.7.0"></script>
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

    $(function(){
      //get the pie chart canvas
      var cData = JSON.parse(`<?php echo $chart; ?>`);
      var ctx = $("#pie-chart");
 
      //pie chart data
      var data = {
        labels: cData.categories,
        datasets: [
          {
            label: "Users Count",
            data: cData.series,
            backgroundColor: [
              "#FF0F00",
              "#FF6600",
            ],
            borderColor: [
              "#FF0F00",
              "#FF6600",
            ],
            borderWidth: [1, 1, 1, 1, 1,1,1]
          }
        ]
      };
 
      //options
      var options = {
        responsive: true,
        title: {
          display: true,
          position: "top",
          // text: "Last Week Registered Users -  Day Wise Count",
          fontSize: 18,
          fontColor: "#111"
        },
        legend: {
          display: true,
          position: "bottom",
          labels: {
            fontColor: "#333",
            fontSize: 14
          }
        },
        plugins: {
          datalabels: {
              formatter: (value, ctx) => {
                  let sum = 0;
                  let dataArr = ctx.chart.data.datasets[0].data;
                  dataArr.map(data => {
                      sum += data;
                  });
                  let percentage = (value*100 / sum).toFixed(2)+"%";
                  return percentage;
              },
              color: '#fff',
          }
        }
      };
 
      //create Pie Chart class object
      var chart1 = new Chart(ctx, {
        type: "pie",
        data: data,
        options: options
      });
 
  });
  </script>
@endpush