<!-- Navigacija -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
    <div class="container">
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarResponsive">
        <ul class="navbar-nav ml-auto">
          @isset($menus)
            @foreach($menus as $menu)
            <li class="nav-item {{ (Request::is($menu->link))? 'active' : '' }}">
              <a class="nav-link" href="{{ asset($menu->link) }}"> 
                {{ $menu->naziv }}
              </a>
            </li>
            @endforeach
          @endisset


           @if(!session()->has('user'))
              <li class="nav-item">
                  <a class="nav-link" href="{{ route('registerView') }}">Register</a>
              </li>
          @endif
          @if(session()->has('user'))
              <li class="nav-item">
                 <a class="nav-link" href="{{ route('go') }}">Anketa</a>
              </li>
          @endif

          @if(session()->has('user'))
            <li>
              <a class="nav-link" href="{{ route('logout') }}">
                Logout
              </a>
            </li>
          @endif
        </ul>
      </div>
    </div>
  </nav>
  <!--// Navigacija -->
