@extends('layouts.front')

@section('title')
    Oglas
@endsection

@section('appendCss')
    @parent
    <!-- Custom styles for this template -->
    <link href="{{ asset('/') }}css/blog-post.css" rel="stylesheet"/>
@endsection

@section('content')
<!-- Sadrzaj -->
  @isset($singleOglas)
      <div class="col-md-8">

          <h1 class="my-4">Oglasi
            <small>vozila</small>
          </h1>

          <!-- Oglas -->
          <div class="card mb-4">
            <img class="card-img-top" src="{{ asset('/'.$singleOglas->putanja) }}" alt="{{ $singleOglas->alt }}">
              <div class="card-body">
                <h2 class="card-title">{{ $singleOglas->naslov }}</h2>
                <p class="card-text">
                  {{ $singleOglas->sadrzaj }}
                </p>
              </div>
            <a href="{{ URL::previous() }}" class="btn btn-default">Back</a>
          </div>
          <!--// Oglas -->


     </div>
  @endisset
		<!--// Sadrzaj -->
@endsection