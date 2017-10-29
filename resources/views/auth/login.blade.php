@extends('welcome')
@section('title', 'Login')

@section('content')
<div class="container">
    <div class="row">
       <div class="col-md-6 offset-md-3">
           <div class="card">
               <div class="card-header bg-dark text-white"><b>Login</b></div>
               <div class="card-body">
                   <form method="POST" action="{{ route('login') }}">
                       {{ csrf_field() }}
                       <div class="form-group">
                           <label for="username">User Name</label>
                           <div>
                               <input id="username" type="text" class="form-control{{ $errors->has('username') ? ' is-invalid' : '' }}" name="username" value="{{ old('username') }}" required autofocus placeholder="User Name">

                               @if ($errors->has('username'))
                                   <div class="invalid-feedback">
                                       {{ $errors->first('username') }}
                                   </div>
                               @endif
                           </div>
                       </div>

                       <div class="form-group">
                           <label for="password">Password</label>

                           <div>
                               <input id="password" type="password" class="form-control {{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required placeholder="Password">

                               @if ($errors->has('password'))
                                   <div class="invalid-feedback">
                                       {{ $errors->first('password') }}
                                   </div>
                               @endif
                           </div>
                       </div>

                       <div class="form-group">
                           <div>
                               <div class="checkbox">
                                   <label>
                                       <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> <small>Remember Me</small>
                                   </label>
                                   <a class="pull-right" href="{{ route('password.request') }}"><small>Forgot Your Password?</small></a>
                               </div>

                           </div>
                       </div>

                       <div class="form-group">
                           <div>
                               <button type="submit" class="btn btn-primary btn-block">Login</button>
                           </div>
                       </div>
                   </form>
               </div>
           </div>
       </div>
    </div>
</div>
@endsection
