@extends('layouts.front')

@section('title')
    Kreiraj oglas
@endsection

@section('appendCss')
    @parent
    <!-- Custom styles for this template -->
    <link href="{{ asset('/') }}css/blog-post.css" rel="stylesheet"/>
@endsection

@section('content')
<!-- Sadrzaj -->
        <div class="col-md-8">
            <h3>Kreiraj oglas</h3>
            
            @isset($errors)
              @if($errors->any())
                @foreach($errors->all() as $error)
                  <div class="alert alert-danger"> {{ $error }} </div>
                @endforeach
              @endif
            @endisset
            
            <form action="{{ asset('/oglasi/store') }}" method="POST" enctype="multipart/form-data">
              {{ csrf_field() }}
              <div class="form-group">
                <label>Naslov:</label>
                <input type="text" name="title" class="form-control" value="{{ old('title') }}"/>
              </div>
              <div class="form-group">
                <label>Sadrzaj:</label>
                <textarea name="body" class="form-control" rows="7">{{ old('body') }}</textarea>
              </div> 
              <div class="form-group">
                <label>Slika:</label>
                <input type="file" name="photo" class="form-control" />
              </div>
              <div class="form-group">
                <label>Alt:</label>
                <input type="text" name="alt" class="form-control" value="{{ old('alt') }}"/>
              </div>
              <div class="form-group">
                <input type="submit" name="addPost" value="Dodaj oglas" class="btn btn-primary" />
              </div> 
            </form>
            
        </div>
		<!--// Sadrzaj -->
@endsection