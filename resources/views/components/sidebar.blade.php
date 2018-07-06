<!-- Desna strana -->
<div class="col-md-4">
     
     @include('components.search')

    @if(!session()->has('user'))
    <div class="card my-4">
      <h5 class="card-header">Login</h5>
      <div class="card-body">
        <div class="row">
          <div class="col-lg-12">


            @isset($errors)
              @if($errors->any())
                @foreach($errors->all() as $error)
                  {{ $error }}
                @endforeach
              @endif
            @endisset

            <!-- LOGIN FORM -->          
            <form action="{{ route('login') }}" method="POST" onsubmit="return proveraPrijava()">
              {{ csrf_field() }}
              <div class="form-group">
                  <label>Korisnicko ime:</label>
                  <input type="text" name="tbKorisnickoIme" id="tbKorImePrijava" class="form-control" required="true"/>
                  <span id="korIErr"></span><br/>
              </div>
              
              <div class="form-group">
                <label>Lozinka:</label>
                <input type="password" name="tbLozinka" id="tbLozPrijava" class="form-control" required="true"/>
                <span id="lozErr"></span><br/>
              </div>
              
              <input type="submit" name="btnLogin" value="Login" class="btn btn-primary"/>
            
            </form>
            <!--// LOGIN FORM -->

          </div>
        </div>
      </div>
    </div>
    @endif
     <br/>
        @if(session()->has('user')) 
              <div class="nav-item">
                 <a href="{{ asset('/oglasi/create') }}" class="btn btn-info">Postavi oglas</a>
              </div>
        @endif
     <br/>
   @if(session()->has('user') && session()->get('user')[0]->naziv == 'admin')  
    <div class="card my-4">
      <h5 class="card-header">Admin Panel</h5>
      <div class="card-body">
          <a href="{{ asset('/all') }}" class="btn btn-info">Svi oglasi</a>
          <a href="{{ asset('/oglasi') }}" class="btn btn-info">Odobreni oglasi</a>
          <hr/>
          <a href="{{ asset('/users') }}" class="btn btn-success">Editovanje korisnika</a>
          <hr/>
          <a href="{{ asset('/roles') }}" class="btn btn-primary">Promeni uloge</a>  
          <a href="{{ asset('/meni') }}" class="btn btn-primary">Promeni meni</a>  
          <hr/>
          <a href="{{ asset('/ankete') }}" class="btn btn-warning">Edituj ankete</a>      
      </div>
    </div>
    @endif
  </div>
  <!--// Desna strana -->
