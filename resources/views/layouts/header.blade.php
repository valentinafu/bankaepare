<header class="main-header">

    <a href="/" class="logo">
        <span class="logo-mini">Logo</span>
        <span>Banka e Parë</span>
    </a>

    <nav class="navbar">

        <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button"></a>

        <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">

                @if (Auth::user() && Auth::user()->role == 3)
                    <li class="nav-item">
                        <a class="nav-link" href="/admin"><span class="hidden-xs">Admin Panel</span></a>
                    </li>
                @elseif (Auth::user() && Auth::user()->role == 2)
                    <li class="nav-item">
                        <a class="nav-link" href="/moderator">Moderator Panel</a>
                    </li>
                @endif

                @if (Auth::guest())
                    <li><a href="/login"><span class="hidden-xs">Login</span></a></li>
                @else
                    <li class="dropdown user user-menu">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <img src="{{ auth()->user()->avatar }}" alt="Avatar" class="user-image">
                            <span class="hidden-xs">{{ Auth::user()->name }}</span>
                        </a>

                        <ul class="dropdown-menu">
                            <li class="user-header">
                                <img src="{{ auth()->user()->avatar }}" class="img-circle" alt="Avatar">
                            </li>
                            <li class="user-footer">
                                <div class="pull-right">
                                    <form id="logout-form" action="/logout" method="POST">
                                        {{ csrf_field() }}
                                        <button type="submit" class="btn btn-default btn-flat">Log Out</button>
                                    </form>
                                </div>
                            </li>
                        </ul>

                    </li>
                @endif

            </ul>
        </div>
    </nav>
</header>