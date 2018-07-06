@extends('layouts.front')

@section('title')
    Meni
@endsection

@section('appendCss')
    @parent
    <!-- Custom styles for this template -->
    <link href="{{ asset('/') }}css/blog-post.css" rel="stylesheet"/>
@endsection

@section('content')
<!-- Sadrzaj -->
        <div class="col-md-8">
            <h3 class="my-4">Add
              <small>meni</small>
            </h3>
            
            @isset($errors)
              @if($errors->any())
                @foreach($errors->all() as $error)
                  <div class="alert alert-danger"> {{ $error }} </div>
                @endforeach
              @endif
            @endisset
            
            @if(session()->has('user') && session()->get('user')[0]->naziv == 'admin')
            <form action="{{ isset($updateMeni)? asset('/meni/update/'.$updateMeni->id) : asset('/meni/store') }}" method="POST">
              {{ csrf_field() }}
              <div class="form-group">
                <label>Naziv:</label>
                <input type="text" name="naziv" class="form-control" value="{{ isset($updateMeni)? $updateMeni->naziv : old('naziv') }}"/>
              </div>
              <div class="form-group">
                <label>Link:</label>
                <input type="text" name="link" class="form-control" value="{{ isset($updateMeni)? $updateMeni->link : old('link') }}"/>
              </div>
              <div class="form-group">
                <input type="submit" name="addMeni" value="{{ isset($updateMeni)? 'Change meni' : 'Add meni' }}" class="btn btn-secondary" />
              </div> 
            </form>

            <table class="table">
              <tr>
                <th>ID</th>
                <th>Naziv</th>
                <th>Link</th>
                <th>Izmeni</th>
                <th>Obrisi</th>
              </tr>

              @foreach($meni as $m)
                <tr>
                  <td>{{ $m->id }}</td>
                  <td>{{ $m->naziv }}</td>
                  <td>{{ $m->link }}</td>
                  <td><a href="{{ asset('/meni/'.$m->id) }}">Izmeni</a></td>
                  <td><a href="{{ asset('/meni/destroy/'.$m->id) }}">Obrisi</a></td>
                </tr>
              @endforeach
            </table>
            @endif
        </div>
		<!--// Sadrzaj -->
@endsection