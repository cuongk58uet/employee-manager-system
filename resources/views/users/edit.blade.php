@extends('layouts.app')
@section('title', 'Edit Employee')

@section('content')
    <div class="container">
        <div class="row">
            @include('users/breadcrumb')
            @include('shared/alert')
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header bg-dark text-white">User Edit</div>
                    <div class="card-body">
                        <form action="{{ route('user.update') }}" method="POST">
                            {{ csrf_field() }}
                            <div class="form-row">
                                <fieldset class="form-group">
                                    <input type="hidden" name="id" class="form-control" id="id" value="{{ $user->id }}">
                                </fieldset>
                                <fieldset class="form-group col-md-12">
                                    <b>Email</b>
                                    <input type="email" name="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" id="email" value="{{ $user->email }}">
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
                                    <input type="text" name="firstname" class="form-control" id="firstname" value="{{ $user->firstname }}" required>
                                </fieldset>
                                <fieldset class="form-group col-md-6">
                                    <b>Last Name</b>
                                    <input type="text" name="lastname" class="form-control" id="lastname" value="{{ $user->lastname }}" required>
                                </fieldset>
                            </div>

                            <hr>
                            <fieldset class="form-group">
                                <b>Gender</b>
                                <select class="form-control" name="gender" id="gender">
                                      <option value="Man">Man</option>
                                      <option value="Woman">Woman</option>
                                    </select>
                            </fieldset>
                            <hr>
                            <fieldset class="form-group">
                                <b>Address</b>
                                <input type="text" name="address" class="form-control" id="address" value="{{ $user->address }}">
                            </fieldset>
                            <a class="btn btn-secondary" href="{{ route('users') }}">Cancel</a>
                            <button type="submit" class="btn btn-success" id="editUser">Save change</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
