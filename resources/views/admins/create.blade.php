@extends('layouts.app')
@section('title', 'Create User')

@section('content')
    <div class="container">
        <div class="row">
            @include('admins.breadcrumb')
            @include('shared/alert')
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header bg-dark text-white">Create User</div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('user.create') }}">
                            {{ csrf_field() }}
                            <fieldset class="form-group">
                                <label for="username">User Name</label>
                                <input type="text" class="form-control{{ $errors->has('username') ? ' is-invalid' : '' }}" name="username" id="username" placeholder="User name" required>
                                @if ($errors->has('username'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('username') }}
                                    </div>
                                @endif
                            </fieldset>
                            <fieldset class="form-group">
                                <label for="email">Email</label>
                                <input type="email" class="form-control {{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" id="email" placeholder="Email" required>
                                @if ($errors->has('email'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('email') }}
                                    </div>
                                @endif
                            </fieldset>
                            <button type="submit" class="btn btn-block btn-primary">Create</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
