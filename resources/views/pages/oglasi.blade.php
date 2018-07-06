@extends('layouts.front')

@section('title')
    Oglasi
@endsection

@section('appendCss')
    @parent
    <!-- Custom styles for this template -->
    <link href="{{ asset('/') }}css/blog-post.css" rel="stylesheet"/>
@endsection

@section('content')
<!-- Sadrzaj -->

         <div class="col-md-8">
            <h3 class="my-4">Edit
              <small>oglasi</small>
            </h3>
            
            @empty(!session('message'))
              {{ session('message') }}
            @endempty

            @isset($errors)
              @if($errors->any())
                @foreach($errors->all() as $error)
                  <div class="alert alert-danger"> {{ $error }} </div>
                @endforeach
              @endif
            @endisset

            @if(session()->has('user') && session()->get('user')[0]->naziv == 'admin')
            <table class="table">
                <tr>
                  <th>Naslov</th>
                  <th>Sadrzaj</th>
                  <th>Slika</th>
                  <th>Izmeni</th>
                  <th>Obrisi</th>
                </tr>
                <!-- Prikaz oglasa-->
              @isset($oglasi)
                @foreach($oglasi as $oglas)
                  <tr>
                    <td> {{ $oglas->naslov }} </td>
                    <td> {{ $oglas->sadrzaj }} </td>
                    <td> <img src="{{ asset($oglas->putanja) }}" width="150"/> </td>
                    <td> <a href="{{ asset('/oglasi/edit/'.$oglas->id) }}">Izmeni</a> </td>
                    <td> <a href="{{ asset('/oglasi/destroy/'.$oglas->id) }}">Obrisi</a> </td>
                  </tr>
                @endforeach
              @endisset
            </table>
              <!-- Pagination -->
          <div class="panel-heading" style="display:flex; justify-content:center;align-items:center;">
            {{$oglasi->links()}}
          </div>
          @endif
        </div>
		<!--// Sadrzaj -->
@endsection