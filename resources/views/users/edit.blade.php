@extends('layouts.app')
@section('title', 'Edit Employee')

@section('content')
    <div class="container">
        <div class="row">
            @include('users/breadcrumb')
            @include('shared/alert')
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header bg-success text-white">Change Profile</div>
                    <div class="card-body">
                        <form action="{{ route('user.profile.edit') }}" method="POST">
                            {{ csrf_field() }}
                            <fieldset class="form-group">
                                <input type="hidden" name="id" class="form-control" id="id" value="{{ $user->id }}">
                            </fieldset>
                            <table class="table">
                                <tbody>
                                    <tr>
                                        <td rowspan="4" class="avatar_area">
                                        @if($user->avatar)
                                            <img src="{{asset($user->avatar)}}" alt="" class="rounded-circle avatar">
                                        @else
                                            <img src="{{asset('images/avatar.jpg')}}" alt="" class="rounded-circle avatar">
                                        @endif
                                            <fieldset class="form-group">
                                                <label class="custom-file">
                                                    <input type="file" name="avatar" id="avatar" class="custom-file-input{{ $errors->has('avatar') ? ' is-invalid' : '' }}">
                                                    <span class="custom-file-control"></span>
                                                </label>
                                                @if ($errors->has('avatar'))
                                                    <div class="invalid-feedback">
                                                        {{ $errors->first('avatar') }}
                                                    </div>
                                                @endif
                                            </fieldset>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <fieldset class="form-group">
                                                <b>Email</b>
                                                <input type="email" name="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" id="email" value="{{ $user->email }}" required>
                                                @if ($errors->has('email'))
                                                    <div class="invalid-feedback">
                                                        {{ $errors->first('email') }}
                                                    </div>
                                                @endif
                                            </fieldset>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <fieldset class="form-group">
                                                <b>First Name</b>
                                                <input type="text" name="firstname" class="form-control{{ $errors->has('firstname') ? ' is-invalid' : '' }}" id="firstname" value="{{ $user->firstname }}" required>
                                                @if ($errors->has('firstname'))
                                                    <div class="invalid-feedback">
                                                        {{ $errors->first('firstname') }}
                                                    </div>
                                                @endif
                                            </fieldset>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <fieldset class="form-group">
                                                <b>Last Name</b>
                                                <input type="text" name="lastname" class="form-control{{ $errors->has('lastname') ? ' is-invalid' : '' }}" id="lastname" value="{{ $user->lastname }}" required>
                                                @if ($errors->has('lastname'))
                                                    <div class="invalid-feedback">
                                                        {{ $errors->first('lastname') }}
                                                    </div>
                                                @endif
                                            </fieldset>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            <hr>
                            <div class="form-row">
                                <fieldset class="form-group col-md-9">
                                    <b>Address</b>
                                    <input type="text" name="address" class="form-control{{ $errors->has('address') ? ' is-invalid' : '' }}" id="address" value="{{ $user->address }}" required>
                                    @if ($errors->has('address'))
                                        <div class="invalid-feedback">
                                            {{ $errors->first('address') }}
                                        </div>
                                    @endif
                                </fieldset>
                                <fieldset class="form-group col-md-3">
                                    <b>Gender</b>
                                    <select class="form-control{{ $errors->has('gender') ? ' is-invalid' : '' }}" name="gender" id="gender" required>
                                        @if($user->gender == 'Man')
                                            <option value="Man" selected>Man</option>
                                            <option value="Woman">Woman</option>
                                        @else
                                            <option value="Man">Man</option>
                                            <option value="Woman" selected>Woman</option>
                                        @endif
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
                                    <input type="date" class="form-control" name="birthday" value="{{$user->birthday}}">
                                </fieldset>
                            </div>
                            <hr>
                            <fieldset class="col-md-6 offset-md-6">
                            <a class="btn btn-secondary" href="{{ route('dashboard') }}">Cancel</a>
                            <button type="submit" class="btn btn-success" id="editUser">Save change</button>
                            </fieldset>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
