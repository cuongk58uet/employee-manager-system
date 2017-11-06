@extends('welcome')
@section('title', 'Reset Password')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-6 offset-md-3">
            @include('shared.alert')
            <div class="card">
                <div class="card-header bg-dark text-white">Reset Password</div>

                <div class="card-body">
                    <form id="form-reset" method="POST" action="{{ route('password.reset.first') }}">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label for="password">Password</label>
                            <div>
                                <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required autofocus>
                                <span class="invalid-feedback"></span>
                                @if ($errors->has('password'))
                                    <span class="invalid-feedback">
                                        {{ $errors->first('password') }}
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="password-confirm">Confirm Password</label>
                            <div>
                                <input id="password-confirm" type="password" class="form-control{{ $errors->has('password_confirmation') ? ' is-invalid' : '' }}" name="password_confirmation" required>
                                <span class="invalid-feedback"></span>
                                @if ($errors->has('password_confirmation'))
                                    <span class="invalid-feedback">
                                        {{ $errors->first('password_confirmation') }}
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <div>
                                <button type="submit" class="btn btn-block btn-success" id="submit">Reset Password
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@include('shared.logout-modal')
@endsection
