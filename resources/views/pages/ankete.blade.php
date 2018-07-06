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
  <h2 class="mt-4">Anketa</h2>
@if(session()->has('user') && session()->get('user')[0]->naziv == 'admin')

@isset($ankete)
<table class="table">
<tr>
<th>id</th>
<th>pitanje</th>
<th>aktivna</th>
<th>izmena</th>
<th>brisanje</th>
</tr>

@foreach($ankete as $a)
<tr>
<td>{{$a->idAnketa}}</td>
<td>{{$a->pitanje}}</td>
<td>{{$a->aktivna}}</td>
<td><a href="{{route('admin', ['id' => $a->idAnketa])}}">izmeni</a></td>
<td><a href="{{route('izbrisiAnketu', ['id' => $a->idAnketa])}}">obriši</a></td>
</tr>
@endforeach
</table><hr><br/>


<div id="anketaPodesavanja">

    <form class="form-control" id="dodajAnketu" method="post" action="{{ (isset($anketa))? route('izmeniAnketu', ['id' => $anketa->idAnketa]) : route('dodajAnketu') }}" >
    {{ csrf_field() }}
    <h4 class="form-signin-heading">Dodaj/izmeni anketu</h4><br/>
    <input type="text" class="form-control" name="pitanje" id="pitanje" placeholder="Pitanje" required="true" value="{{(isset($anketa))? $anketa->pitanje : old('pitanje')}}" /><br/>
    <button class="btn btn-lg btn-primary btn-block" type="submit">{{ (isset($anketa))? 'Izmeni' : 'Dodaj' }}</button> <br/>
    </form>
    <br/>
    <form class="form-control" id="podesiAktivnu" action=" {{route('podesiAktivnu')}}" method="post">
    {{ csrf_field() }}
    <h4>Podesi aktivnu anketu</h4><br/>
    <select class="form-control" name="activeList">
    <option value="0">Izaberi anketu...</option>
    @foreach($ankete as $a)
    <option class="form-control" value="{{$a->idAnketa}}">{{$a->pitanje}}</option>
    @endforeach
    </select><br/>
    <button class="btn btn-lg btn-primary btn-block" type="submit">Podesi</button> <br/>
    </form>

</div>

<br/>
<div id="odgovoriPodesavanja">
    <form class="form-control" id="odgovriAnketa" method="post" action="{{ route('dodajOdgovor') }}">
    {{ csrf_field() }}
    <h4>Podesi odgovore</h4><br/>
    <select class="form-control" name="activeList" onChange="prikaziOdgovore(this.value)">
    <option value="0">Izaberi anketu...</option>
    @foreach($ankete as $a)
    <option class="form-control" value="{{$a->idAnketa}}" {{ (isset($odgovor) && $odgovor->idAnketa == $a->idAnketa)? 'selected' : (old('activeList')== $a->idAnketa)? 'selected' : '' }} >{{$a->pitanje}}</option>
    @endforeach
    </select><br/>Odgovore razdvojite sa ;
    <input type="text" name="odgovorPlus" class="form-control" value="{{(isset($odgovor))? $odgovor->odgovor : old('odgovorPlus')}}" placeholder="Odgovori"/><br/>
    <button class="btn btn-lg btn-primary btn-block" type="submit">{{ (isset($odgovor))? 'Izmeni odgovor' : 'Dodaj odgovor' }} </button> <br/>
    </form>
    <br/>
    <div id="odgovori">

    </div>
    @endisset

    @if(!isset($ankete))
     <span>Nema anketa za prikaz</span>
     <hr>
    @endif
 </div>

  </div>
@endif
		<!--// Sadrzaj -->
@endsection

@section('appendJavascript')
 @parent
 <script type="text/javascript" src="{{ asset('js/ajax.js') }}"></script>
@endsection