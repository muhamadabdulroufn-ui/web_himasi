@extends('layouts.front')

@section('title', 'Berita')

@section('content')
<div class="content my-5">
  <div class="container">
    <div class="row"> 
      <div class="col-12">
          <article class="blog-post">
              <img src="{{ Storage::url($news->image) }}" alt="">
              <div class="content">
                  <small>{{ \Carbon\Carbon::parse($news->created_at)->format('d F Y') }}</small>
                  <small>By {{ $news->creator->name }}</small>
                  <h3>{{ $news->title }}</h3>
                  <p>{!! $news->description !!}</p>
              </div>
          </article>
      </div>
  </div>
  </div>
</div>
@endsection