@extends('layouts.front')

@section('title')
    Uloge
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
              <small>uloga</small>
            </h3>
            
            @isset($errors)
              @if($errors->any())
                @foreach($errors->all() as $error)
                  <div class="alert alert-danger"> {{ $error }} </div>
                @endforeach
              @endif
            @endisset
            
            @if(session()->has('user') && session()->get('user')[0]->naziv == 'admin')
            <form action="{{ isset($updateRole)? asset('/roles/update/'.$updateRole->id) : asset('/roles/store') }}" method="POST">
              {{ csrf_field() }}
              <div class="form-group">
                <label>Naziv:</label>
                <input type="text" name="naziv" class="form-control" value="{{ isset($updateRole)? $updateRole->naziv : old('naziv') }}"/>
              </div>
              <div class="form-group">
                <input type="submit" name="addUloga" value="{{ isset($updateRole)? 'Change role' : 'Add uloga' }}" class="btn btn-secondary" />
              </div> 
            </form>

            <table class="table">
              <tr>
                <th>ID</th>
                <th>Naziv</th>
                <th>Izmeni</th>
                <th>Obrisi</th>
              </tr>

              @foreach($roles as $role)
                <tr>
                  <td>{{ $role->id }}</td>
                  <td>{{ $role->naziv }}</td>
                  <td><a href="{{ asset('/roles/'.$role->id) }}">Izmeni</a></td>
                  <td><a href="{{ asset('/roles/destroy/'.$role->id) }}">Obrisi</a></td>
                </tr>
              @endforeach
            </table>
            @endif
        </div>
		<!--// Sadrzaj -->
@endsection