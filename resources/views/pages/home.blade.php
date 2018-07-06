@extends('layouts.front')

@section('title')
    Home page
@endsection

@section('appendCss')
    @parent
    <!-- Custom styles for this template -->
    <link href="{{ asset('/') }}css/blog-post.css" rel="stylesheet"/>
@endsection

@section('content')
<!-- Sadrzaj -->
        <div class="col-md-8">

          <h1 class="my-4">Oglasi
            <small>vozila</small>
          </h1>
          @if($oglasi->isEmpty())
            Nema takvog oglasa!          
          @endif         

          @isset($oglasi)
            @foreach($oglasi as $oglas)
          <!-- Oglas -->
          <div class="card card-body mb-4">
          <img class="card-img-top img-rounded" src="{{ asset('/'.$oglas->putanja) }}" alt="{{ $oglas->alt }}">
            <div class="card-body">
              <h2 class="card-title">{{ $oglas->naslov }}</h2>
              <p class="card-text">
                {{ str_limit(strip_tags($oglas->sadrzaj), 50) }}
              </p>               
                @if (strlen(strip_tags($oglas->sadrzaj)) > 50)
                  <a href="{{ url('/oglasi/'.$oglas->id )}}" class="btn btn-primary">Read More &rarr;</a>
                @endif
            </div>
            <div class="card-footer text-muted">
              Created at {{ date("d.m.Y H:i:s", $oglas->created_at) }} by
              {{ isset($oglas->korisnicko_ime) ? $oglas->korisnicko_ime : 'admin' }}
              @if(session()->has('user') && session()->get('user')[0]->naziv == 'admin')
                @if($oglas->approved == 0)         
                  <a href="{{ url('/oglasi/approve/'.$oglas->id )}}" class="btn btn-default float-right">Approve</a>   
                  <a href="{{ url('/oglasi/destroy/'.$oglas->id )}}" class="btn btn-default float-right">Reject</a>      
                @endif
              @endif
            </div>
          </div>
		<!--// Oglas -->
            @endforeach
	      	@endisset
		
          <!-- Pagination -->
          <div class="panel-heading" style="display:flex; justify-content:center;align-items:center;">
            {{$oglasi->links()}}
          </div>
         
        </div>
		<!--// Sadrzaj -->
@endsection