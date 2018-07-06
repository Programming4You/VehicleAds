<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title> Oglasi vozila | @yield('title') </title>

    @section('appendCss')
    <!-- Bootstrap core CSS -->
    <link href="{{ asset('/') }}vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
	  <link href="{{ asset('/') }}css/blog-home.css" rel="stylesheet">
    @show
    <link rel="shortcut icon" href="{{ asset('/') }}images/favicon.ico"/>
  </head>

  <body>

    @include('components.nav')
	
    <div class="container">

      <div class="row">
     
        <div class="col-lg-12">
          @empty(!session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
          @endempty

          @empty(!session('success'))
            <div class="alert alert-success">{{ session('success') }} </div>
          @endempty
        </div>

        <!-- SADRZAJ-->
        @yield('content')

        @include('components.sidebar')
		
      </div>

    </div>
	
	
    @include('components.footer')
	
	
    @section('appendJavascript')
    <!-- Bootstrap core JavaScript -->
    <script src="{{ asset('/') }}vendor/jquery/jquery.min.js"></script>
    <script src="{{ asset('/') }}vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('/') }}js/provera.js"></script>
    <script type="text/javascript">
        const baseUrl = '{{ asset("/") }}';
        const token = '{{ csrf_token() }}';
    </script>
    @show
    
  </body>

</html>

