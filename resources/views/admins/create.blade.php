@extends('layouts.app')
@section('title', 'Create Account')

@section('content')
    <div class="container">
        <div class="row">
            @include('admins.breadcrumb')
            @include('shared/alert')
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header bg-dark text-white">Create Account</div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('admin.create') }}">
                            {{ csrf_field() }}
                            <div class="form-row">
                                <fieldset class="form-group col-md-6">
                                    <b>User Name</b>
                                    <input type="text" class="form-control{{ $errors->has('username') ? ' is-invalid' : '' }}" name="username" id="username" placeholder="User name" required value="{{old('username')}}">
                                    @if ($errors->has('username'))
                                        <div class="invalid-feedback">
                                            {{ $errors->first('username') }}
                                        </div>
                                    @endif
                                </fieldset>
                                <fieldset class="form-group col-md-6">
                                    <b>Email</b>
                                    <input type="email" class="form-control {{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" id="email" placeholder="Email" required value="{{old('email')}}">
                                    @if ($errors->has('email'))
                                        <div class="invalid-feedback">
                                            {{ $errors->first('email') }}
                                        </div>
                                    @endif
                                </fieldset>
                            </div>
                            <hr>
                            <div class="form-row">
                                <fieldset class="form-group col-md-6">
                                    <b>First Name</b>
                                    <input type="text" name="firstname" class="form-control{{ $errors->has('firstname') ? ' is-invalid' : '' }}" id="firstname" value="{{ old('firstname') }}" required placeholder="First Name">
                                    @if ($errors->has('firstname'))
                                        <div class="invalid-feedback">
                                            {{ $errors->first('firstname') }}
                                        </div>
                                    @endif
                                </fieldset>
                                <fieldset class="form-group col-md-6">
                                    <b>Last Name</b>
                                    <input type="text" name="lastname" class="form-control{{ $errors->has('lastname') ? ' is-invalid' : '' }}" id="lastname" value="{{ old('lastname') }}" required placeholder="Last Name">
                                    @if ($errors->has('lastname'))
                                        <div class="invalid-feedback">
                                            {{ $errors->first('lastname') }}
                                        </div>
                                    @endif
                                </fieldset>
                            </div>
                            <hr>
                            <div class="form-row">
                                <fieldset class="col-md-9">
                                    <b>Address</b>
                                    <input type="text" name="address" class="form-control{{ $errors->has('address') ? ' is-invalid' : '' }}" id="address" value="{{ old('address') }}" required>
                                    @if ($errors->has('address'))
                                        <div class="invalid-feedback">
                                            {{ $errors->first('address') }}
                                        </div>
                                    @endif
                                </fieldset>
                                <fieldset class="form-group col-md-3">
                                    <b>Gender</b>
                                    <select class="form-control{{ $errors->has('gender') ? ' is-invalid' : '' }}" name="gender" id="gender" required>
                                        <option value="Man">Man</option>
                                        <option value="Woman">Woman</option>
                                    </select>
                                    @if ($errors->has('gender'))
                                        <div class="invalid-feedback">
                                            {{ $errors->first('gender') }}
                                        </div>
                                    @endif
                                </fieldset>
                            </div>
                            <hr>
                            <div class="form-row">
                                <fieldset class="col-md-6 offset-md-6">
                                    <b>Date of birth: </b>
                                    <input type="date" class="form-control" name="birthday" value="{{old('birthday')}}">
                                </fieldset>
                            </div>
                            <hr>
                            <div class="col-md-6 offset-md-6">
                                <a href="{{route('dashboard')}}" class="btn btn-secondary">Cancel</a>
                                <button type="submit" class="btn btn-primary">Create Account</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
