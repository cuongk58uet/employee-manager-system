<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top" id="mainNav">
    <a class="navbar-brand" href="{{ url('/') }}">EmployeeManagerSystem</a>
    <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarResponsive">
        <ul class="navbar-nav ml-auto">
           @guest
               <li class="nav-item"></li>
           @else
               <li class="nav-item">
                   <a class="nav-link" href="#">{{Auth::user()->firstname . ' ' . Auth::user()->lastname}}</a>
               </li>
               <li class="nav-item">
                   <a class="nav-link" data-toggle="modal" data-target="#exampleModal"> <i class="fa fa-power-off" aria-hidden="true"></i></a>
               </li>
           @endguest
        </ul>
    </div>
</nav>
