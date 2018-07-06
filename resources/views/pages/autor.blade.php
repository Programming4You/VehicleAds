@extends('layouts.front')

@section('title')
    Autor
@endsection

@section('appendCss')
    @parent
    <!-- Custom styles for this template -->
    <link href="{{ asset('/') }}css/blog-post.css" rel="stylesheet"/>
@endsection

@section('content')
<!-- Sadrzaj -->
        <div class="col-md-8">

          <h1 class="my-4">O
            <small>Autoru</small>
          </h1>
          
   
          <div class="card card-body mb-4">
            <div class="well">
              <p>Milan Čučković - student of ICT College of Vocational Studies in Belgrade</p>
              <p>The website was created for educational purposes (PHP - Laravel framework) and has no commercial effect. The ads are not real, all the images of the vehicles belong to their authors, and the phone numbers are given as an example.</p>
            </div>
            <img class="card-img-top" src="{{ asset('/') }}images/author.jpg" alt="Autor">
          </div>
	

        </div>
		<!--// Sadrzaj -->
@endsection