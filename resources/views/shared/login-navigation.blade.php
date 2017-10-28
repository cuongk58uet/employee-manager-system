<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top" id="mainNav">
    <a class="navbar-brand" href="{{ url('/') }}">EmployeeManagerSystem</a>
    <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
    </button>
    <ul class="navbar-nav ml-auto">
        @guest

        @else
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown">{{ Auth::user()->firstname . ' ' . Auth::user()->lastname }}</a>
                <div class="dropdown-menu">
                    <a class="dropdown-item small" href="{{route('logout')}}">Logout</a>
                </div>
            </li>
        @endguest
    </ul>
</nav>
