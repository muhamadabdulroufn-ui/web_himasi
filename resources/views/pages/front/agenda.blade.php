@extends('layouts.front')

@section('title', 'Agenda')

@section('content')

<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-4" id="name"></h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <h5 id="date" class="fw-normal"></h5>
        <h5 id="address" class="fw-normal"></h5>
        <p id="description"></p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>


<div class="" style="background-image: url({{ URL::asset('assets/img/bg-banner.jpg') }}), linear-gradient(rgba(44, 70, 79, 0.9), rgba(44, 70, 79, 0.9)) ; background-size: cover; background-repeat: no-repeat; background-position: center; background-blend-mode: overlay;">
  <div class="container">
    <div class="row justify-content-center align-items-center">
        <div class="col-12 text-center text-white">
            <h3 class="text-uppercase text-white" style="margin: 100px 0 100px 0">Agenda</h3>
        </div>
    </div>
  </div>
</div>

<div class="content my-5">
  <div class="container">
    <div class="row">
      @forelse ($agenda as $agenda)
        <div class="col-md-4 mt-4">
          <div class="card p-3 text-center shadow border-0 h-100">
            <div class="profile-img-container">
              <img src="{{ Storage::url($agenda->thumbnail) }}" class="img-responsive" />
              <a type="button" id="detail" class="btn btn-primary" data-bs-toggle="modal"         data-bs-target="#exampleModal"
                data-name="<?=$agenda->name?>"
                data-date="<?=\Carbon\Carbon::parse($agenda->date)->format('d F Y')?>"
                data-description="<?=$agenda->description?>"
                data-address="<?=$agenda->address?>"
              ><span class="bx bxs-show"></span></a>
            </div>
          </div>
        </div>
      @empty
        <div class="text-center">Belum ada data!</div>
      @endforelse
    </div>
  </div>
</div>
@endsection

@push('addon-script')
<script src="{{ asset('assets/js/jquery.min.js') }}"></script>
  <script>
    $(document).ready(function () {
      $(document).on('click', '#detail', function() {
        var name = $(this).data('name')
        var date = $(this).data('date')
        var description = $(this).data('description')
        var address = $(this).data('address')

        $('#name').text(name)
        $('#date').text(date)
        $('#description').text(description)
        $('#address').text(address)
        
      })
    })
  </script>
@endpush