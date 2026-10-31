@extends('layouts.front')

@section('title', 'Artikel')

@section('content')
<div class="" style="background-image: url({{ URL::asset('assets/img/bg-banner.jpg') }}), linear-gradient(rgba(44, 70, 79, 0.9), rgba(44, 70, 79, 0.9)) ; background-size: cover; background-repeat: no-repeat; background-position: center; background-blend-mode: overlay;">
  <div class="container">
    <div class="row justify-content-center align-items-center">
      <div class="col-12 text-center text-white">
        <h3 class="text-uppercase text-white" style="margin: 100px 0 100px 0">Artikel</h3>
      </div>
    </div>
  </div>
</div>

<div class="content my-5">
  <div class="container">
    <div class="row">
      @forelse ($news as $news)    
      <div class="col-md-4 mb-5 mb-lg-0 mt-4">
          <article class="blog-post h-100">
              <img src="{{ Storage::url($news->image) }}" alt="">
              <span class="tag">{{ $news->category->name }}</span>
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
</div>
@endsection