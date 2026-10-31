@extends('layouts.front')

@section('title', 'Home')

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
<!-- HERO -->
<div class="owl-carousel owl-theme hero-slider">
    <div class="slide slide1" style="background-image: linear-gradient(rgba(0, 0, 0, 0.6), rgba(0, 0, 0, 0.6)), url('{{ $heroBackgrounds[0] }}');">
        <div class="container">
            <div class="row">
                <div class="col-lg-5 mx-auto d-flex">
                    @if ($profiles->logo)
                        <img src="{{ Storage::url($profiles->logo)}}" class=" mx-auto" style="width: 30%" alt="Logo">
                    @endif
                </div>
                <div class="col-12 text-center text-white">
                    <h1 class="display-1 text-white">Selamat Datang</h1>
                    <h4 class="text-white my-4">di Offical Website {{ $profiles->name }}</h4>
                </div>
            </div>
        </div>
    </div>
    <div class="slide slide2" style="background-image: linear-gradient(rgba(0, 0, 0, 0.6), rgba(0, 0, 0, 0.6)), url('{{ $heroBackgrounds[1] }}');">
        <div class="container">
            <div class="row">
                <div class="col-lg-5 mx-auto d-flex">
                    @if ($profiles->logo)
                        <img src="{{ Storage::url($profiles->logo)}}" class=" mx-auto" style="width: 30%" alt="Logo">
                    @endif
                </div>
                <div class="col-12 text-center text-white">
                    <h1 class="display-1 text-white">Selamat Datang</h1>
                    <h4 class="text-white my-4">di Offical Website {{ $profiles->name }}</h4>
                </div>
            </div>
        </div>
    </div>
    <div class="slide slide3" style="background-image: linear-gradient(rgba(0, 0, 0, 0.6), rgba(0, 0, 0, 0.6)), url('{{ $heroBackgrounds[2] }}');">
        <div class="container">
            <div class="row">
                <div class="col-lg-5 mx-auto d-flex">
                    @if ($profiles->logo)
                        <img src="{{ Storage::url($profiles->logo)}}" class=" mx-auto" style="width: 30%" alt="Logo">
                    @endif
                </div>
                <div class="col-12 text-center text-white">
                    <h1 class="display-1 text-white">Selamat Datang</h1>
                    <h4 class="text-white my-4">di Offical Website {{ $profiles->name }}</h4>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- ABOUT -->
<section id="about">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-5 py-5 m-auto text-center">
                <h2>Apa itu {{ $profiles->name }} ?</h2>
                <p>{{ $profiles->description }}</p>
            </div>
            <div class="col-lg-5 mx-auto d-flex">
                @if ($profiles->logo)
                    <img src="{{ Storage::url($profiles->logo)}}" class=" mx-auto" style="width: 50%" alt="Logo">
                @endif
            </div>
        </div>
    </div>
</section>

{{-- AGENDA --}}
<section id="agenda" class="bgagenda">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="intro">
                    <h1>Agenda Terbaru</h1>
                    {{-- <p class="mx-auto">Contrary to popular belief, Lorem Ipsum is not simply random text. It has
                        roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old</p> --}}
                </div>
            </div>
        </div>
        <div class="row">
            @forelse ($agenda as $agenda)    
            <div class="col-md-4 mb-5 mb-lg-0">
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
            <div class="text-center">Belum ada agenda!</div>
            @endforelse
        </div>
    </div>
</section>

{{-- BLOG --}}
<section id="blog">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="intro">
                    <h1>Artikel Terbaru</h1>
                    {{-- <p class="mx-auto">Contrary to popular belief, Lorem Ipsum is not simply random text. It has
                        roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old</p> --}}
                </div>
            </div>
        </div>
        <div class="row">
            @forelse ($news as $news)    
            <div class="col-md-4 mb-5 mb-lg-0" >
                <article class="blog-post h-100">
                    <img src="{{ Storage::url($news->image) }}" alt="">
                    <p class="tag">{{ $news->category->name }}</p>
                    <div class="content">
                        <small>{{ \Carbon\Carbon::parse($news->created_at)->format('d F Y') }}</small>
                        <h5><a href="{{ url('artikel', $news->slug) }}">{{ $news->title }}</a></h5>
                        <p>{!! \Illuminate\Support\Str::words($news->description, 30,'...'); !!}</p>
                    </div>
                </article>
            </div>
            @empty
            <div class="text-center">Belum ada artikel!</div>
            @endforelse
        </div>
    </div>
</section>
@endsection

@push('addon-script')
    <script src="{{ asset('assets/js/jquery.min.js') }}"></script>
    <script>
        function showDetails(id){
            $.ajax({
                url : '{{ route("agendaDetail") }}',
                type: 'GET',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                data:{id:id},
                success:function(data){

                    $('.modal-body').html(data)

                },

            });
        }

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