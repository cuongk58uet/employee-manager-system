<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top" id="mainNav">
    <a class="navbar-brand" href="/">EmployeeManagerSystem</a>
    <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarResponsive">
        <ul class="navbar-nav navbar-sidenav" id="exampleAccordion">
            <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Dashboard">
                <a class="nav-link" href="index.html">
                    <i class="fa fa-home" aria-hidden="true"></i>
                    <span class="nav-link-text">Dashboard</span>
                </a>
            </li>
            <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Components">
                <a class="nav-link nav-link-collapse collapsed" data-toggle="collapse" href="#collapseComponents" data-parent="#exampleAccordion">
                    <i class="fa fa-user" aria-hidden="true"></i>
                    <span class="nav-link-text">Employees</span>
                </a>
                <ul class="sidenav-second-level collapse" id="collapseComponents">
                    <li><a href="#"><i class="fa fa-fw fa-wrench"></i> Management</a></li>
                    <li><a href="#"><i class="fa fa-user-plus" aria-hidden="true"></i> Create</a></li>
                </ul>
            </li>
            <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Example Pages">
                <a class="nav-link nav-link-collapse collapsed" data-toggle="collapse" href="#collapseExamplePages" data-parent="#exampleAccordion">
                    <i class="fa fa-archive" aria-hidden="true"></i>
                    <span class="nav-link-text">Departments</span>
                </a>
                <ul class="sidenav-second-level collapse" id="collapseExamplePages">
                    <li><a href="#"><i class="fa fa-fw fa-wrench"></i> Management</a></li>
                    <li><a href="#"><i class="fa fa-plus" aria-hidden="true"></i>  Create</a></li>
                </ul>
            </li>
            <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Menu Levels">
                <a class="nav-link nav-link-collapse collapsed" data-toggle="collapse" href="#collapseMulti" data-parent="#exampleAccordion">
                    <i class="fa fa-fw fa-sitemap"></i>
                    <span class="nav-link-text">Menu Levels</span>
                </a>
                <ul class="sidenav-second-level collapse" id="collapseMulti">
                    <li><a href="#">Second Level Item</a></li>
                    <li><a class="nav-link-collapse collapsed" data-toggle="collapse" href="#collapseMulti2">Third Level</a>
                        <ul class="sidenav-third-level collapse" id="collapseMulti2">
                            <li><a href="#">Third Level Item</a></li>
                        </ul>
                    </li>
                </ul>
            </li>
        </ul>
        <ul class="navbar-nav sidenav-toggler">
            <li class="nav-item">
                <a class="nav-link text-center" id="sidenavToggler">
                    <i class="fa fa-fw fa-angle-left"></i>
                </a>
            </li>
        </ul>
        <ul class="navbar-nav ml-auto">
            @guest
                <li class="nav-item dropdown"></li>
            @else
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle mr-lg-2" id="messagesDropdown" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">{{ Auth::user()->firstname . ' ' . Auth::user()->lastname }}</a>
                    <div class="dropdown-menu" aria-labelledby="messagesDropdown">
                        <a class="dropdown-item small" href="{{route('logout')}}">Logout</a>
                    </div>
                </li>
            @endguest
        </ul>
    </div>
</nav>
