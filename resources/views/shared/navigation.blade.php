<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top" id="mainNav">
    <a class="navbar-brand" href="/">EmployeeManagerSystem</a>
    <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarResponsive">
        <ul class="navbar-nav navbar-sidenav" id="exampleAccordion">
            <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Dashboard">
                <a class="nav-link" href="{{ route('dashboard') }}">
                    <i class="fa fa-home" aria-hidden="true"></i>
                    <span class="nav-link-text">Dashboard</span>
                </a>
            </li>
        @if (Auth::user()->is_admin)
            <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Components">
                <a class="nav-link nav-link-collapse collapsed" data-toggle="collapse" href="#collapseComponents" data-parent="#exampleAccordion">
                    <i class="fa fa-user" aria-hidden="true"></i>
                    <span class="nav-link-text">Employees</span>
                </a>
                <ul class="sidenav-second-level collapse" id="collapseComponents">
                    <li><a href="{{ route('admins') }}"><i class="fa fa-fw fa-wrench"></i> Management</a></li>
                    <li><a href="{{ route('admin.create') }}"><i class="fa fa-user-plus" aria-hidden="true"></i> Create Account</a></li>
                    <li><a href="{{ route('admin.reset') }}"><i class="fa fa-refresh" aria-hidden="true"></i> Reset Password</a></li>
                </ul>
            </li>
            <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Example Pages">
                <a class="nav-link nav-link-collapse collapsed" data-toggle="collapse" href="#collapseExamplePages" data-parent="#exampleAccordion">
                    <i class="fa fa-archive" aria-hidden="true"></i>
                    <span class="nav-link-text">Departments</span>
                </a>
                <ul class="sidenav-second-level collapse" id="collapseExamplePages">
                    <li><a href="{{ route('departments') }}"><i class="fa fa-fw fa-wrench"></i> Management</a></li>
                    <li><a href="{{ route('department.create') }}"><i class="fa fa-plus" aria-hidden="true"></i>  Create Department</a></li>
                </ul>
            </li>
        @else
            <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Dashboard">
                <a class="nav-link" href="{{ route('user.department') }}">
                    <i class="fa fa-archive" aria-hidden="true"></i>
                    <span class="nav-link-text">My Department</span>
                </a>
            </li>
        @endif
        </ul>
        <ul class="navbar-nav sidenav-toggler">
            <li class="nav-item">
                <a class="nav-link text-center" id="sidenavToggler">
                    <i class="fa fa-fw fa-angle-left"></i>
                </a>
            </li>
        </ul>
        <ul class="navbar-nav ml-auto">
        @auth
            @if (Auth::user()->is_admin)
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle mr-lg-2" href="#" data-toggle="dropdown">
                        <img src="{{asset(Auth::user()->avatar)}}" class="rounded-circle" alt="" width="20" height="20">
                    </a>
                    <div class="dropdown-menu">
                        <h6 class="dropdown-header">Logged in as: </h6>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="{{ route('admin.show', ['id' => Auth::user()->id]) }}">
                          <strong>{{Auth::user()->firstname . ' ' . Auth::user()->lastname}}</strong>
                        </a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="{{ route('admin.edit', ['id' => Auth::user()->id]) }}">Change Profile
                        </a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="{{ route('password.reset.first') }}">Change Password
                        </a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" data-toggle="modal" data-target="#exampleModal"> <i class="fa fa-power-off" aria-hidden="true"></i> Logout</a>
                    </div>
                </li>
            @else
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle mr-lg-2" href="#" data-toggle="dropdown" aria-haspopup="true">
                        <img src="{{asset(Auth::user()->avatar)}}" class="rounded-circle" alt="" width="20" height="20">
                    </a>
                    <div class="dropdown-menu" aria-labelledby="messagesDropdown">
                        <h6 class="dropdown-header">Logged in as: </h6>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="{{ route('user.profile') }}">
                          <strong>{{Auth::user()->firstname . ' ' . Auth::user()->lastname}}</strong>
                        </a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="{{ route('user.profile.edit') }}">Change Profile
                        </a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" data-toggle="modal" data-target="#exampleModal"> <i class="fa fa-power-off" aria-hidden="true"></i> Logout</a>
                    </div>
                </li>
            @endif
        @endauth
        <li class="nav-item">
            <a class="nav-link">
                <i class="fa fa-circle-o" aria-hidden="true"></i>
                <i class="fa fa-circle-o" aria-hidden="true"></i>
                <i class="fa fa-circle-o" aria-hidden="true"></i>
                <i class="fa fa-circle-o" aria-hidden="true"></i>
                <i class="fa fa-circle-o" aria-hidden="true"></i>
            </a>
        </li>
        </ul>
    </div>
</nav>
