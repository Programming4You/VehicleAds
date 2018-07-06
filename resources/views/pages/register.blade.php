@extends('layouts.front')

@section('title')
    Register
@endsection

@section('appendCss')
    @parent
    <!-- Custom styles for this template -->
    <link href="{{ asset('/') }}css/blog-post.css" rel="stylesheet"/>
@endsection

@section('content')
<!-- Sadrzaj -->
  <div class="col-md-8">
    <div class="card my-4">
        <h5 class="card-header text-center">Registruj se</h5>
        <div class="card-body">
            <div class="row">
                <div class="col-lg-6">
               
					@isset($errors)
					  @if($errors->any())
						@foreach($errors->all() as $error)
						  {{ $error }}
						@endforeach
					  @endif
					@endisset
                    

					<!-- REGISTRATION FORM -->          
					<form action="{{ route('registerUser') }}" method="POST" onsubmit="return proveraReg()">
					  {{ csrf_field() }}
					  <div class="form-group">
						  <label>Korisnicko ime:</label> 
						  <input type="text" name="tbKorisnickoImeRegistracija" id="tbKorisnickoImeRegistracija" class="form-control" autofocus="" required="true"/>
						  <span id="korImeErr"></span><br/>
					  </div>
					  
					  <div class="form-group">
						<label>Lozinka:</label>               
						<input type="password" name="tbLozinkaRegistracija" id="tbLozinkaRegistracija" class="form-control" required="true"/>
						<span id="lozinkaErr"></span><br/>
					  </div>
					  
					  <input type="submit" name="btnSignup" value="SignUp" class="btn btn-primary"/>
					
					</form>
                </div>
            </div>
        </div>
    </div>
 </div>
		<!--// Sadrzaj -->
@endsection

