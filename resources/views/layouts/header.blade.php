<nav class="navbar navbar-expand-md fixed-top navbar-dark bg-dark">
  <a class="navbar-brand" href="/">Banka e Parë</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarsExampleDefault">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link" href="/">Home <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#">Link</a>
      </li>
      <li class="nav-item">
        <a class="nav-link disabled" href="#">Disabled</a>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="dropdown01" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Dropdown</a>
        <div class="dropdown-menu" aria-labelledby="dropdown01">
          <a class="dropdown-item" href="#">Action</a>
          <a class="dropdown-item" href="#">Another action</a>
          <a class="dropdown-item" href="#">Something else here</a>
        </div>
      </li>
    </ul>
    <form class="form-inline my-2 my-lg-0">
      <input class="form-control mr-sm-2" type="text" placeholder="Search" aria-label="Search">
      <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
    </form>
      <!-- Right Side Of Navbar -->
      <ul class="nav navbar-nav navbar-right" style="margin-left: 12px;">
          <!-- Authentication Links -->
          @if (Auth::guest())
              <li><a href="/login">Login</a></li>
          @else
              <img src="{{ auth()->user()->avatar }}" alt="Avatar" class="img-circle">
              <p style="color: #ffffff; margin: 12px; vertical-align: center">{{ Auth::user()->name }}</p>
              <a href="/logout" onclick="event.preventDefault();
                 document.getElementById('logout-form').submit();">
                  Logout
              </a>

              <form id="logout-form" action="/logout" method="POST" style="display: none;">
                  {{ csrf_field() }}
              </form>
          @endif
      </ul>
  </div>
</nav>