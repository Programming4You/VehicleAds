@extends('layouts.front')

@section('title')
    Anketa
@endsection

@section('appendCss')
    @parent
    <!-- Custom styles for this template -->
    <link href="{{ asset('/') }}css/blog-post.css" rel="stylesheet"/>
@endsection

@section('content')
<!-- Sadrzaj -->
  <div class="col-md-8">
    <div class="card card-body my-4">
      <h4 class="card card-header text-center">Anketa</h4>
        
         
        @isset($anketa)
         <form class="form-control" method="post">
              {{csrf_field()}}
             <table>
            <tr>
              <th>{{$anketa->pitanje}}</th>
            </tr>
            @isset($odgovori)
              @foreach($odgovori as $odg)
               <tr>
                 <td><input type="radio" class="odgovor" name="odg" value="{{$odg->idOdgovor}}"/>{{$odg->odgovor}}</td>
               </tr>
              @endforeach
              <tr>
            <td><input type="submit" class="form-control btn btn-warning" name="glasaj" id="glasaj" value="Glasaj"/></td>
              </tr>
            @endisset
            </table><br/>
            <div class="alert alert-info" id="anketaObavestenje" style="display: none">

            </div>
         </form>
        @endisset    


    <div class="card card-body my-4">
        <div class="well">
            <h2 class="card-title">Rezultati</h2>
            <div id="rezultatAnkete">
              

            </div>
        </div>
    </div>
        
    </div>

  </div>
		<!--// Sadrzaj -->
@endsection

@section('appendJavascript')
 @parent
 <script type="text/javascript" src="{{ asset('js/ajax.js') }}"></script>
@endsection