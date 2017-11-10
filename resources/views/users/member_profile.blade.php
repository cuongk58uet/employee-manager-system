@extends('layouts.app')
@section('title', 'My Profile')

@section('content')
    <div class="container">
        <div class="row">
            @include('users/breadcrumb')
            @include('shared/alert')
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header bg-dark text-white">Member Profile</div>
                    <div class="card-body">
                        <table class="table">
                            <tbody>
                                <tr>
                                    <td rowspan="3" class="avatar_area">
                                        @if($user->avatar)
                                            <img src="{{asset($user->avatar)}}" alt="" class="rounded-circle avatar">
                                        @else
                                            <img src="{{asset('images/avatar.jpg')}}" alt="" class="rounded-circle avatar">
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <fieldset class="form-group">
                                            <b>User Name</b>
                                            <input type="text" class="form-control" id="username" value="{{ $user->username }}" readonly>
                                        </fieldset>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <fieldset class="form-group">
                                            <b>Email</b>
                                            <input type="text" class="form-control" id="email" value="{{ $user->email }}" readonly>
                                        </fieldset>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <hr>
                        <div class="form-row">
                            <fieldset class="form-group col-md-6">
                                <b>Full Name</b>
                                <input type="text" class="form-control" id="fullname" value="{{ $user->firstname . ' ' . $user->lastname }}" readonly>
                            </fieldset>

                            <fieldset class="form-group col-md-6">
                                <b>Gender</b>
                                <input type="text" class="form-control" id="gender" value="{{ $user->gender }}" readonly>
                            </fieldset>
                        </div>
                        <hr>
                        <div class="form-row">
                            <fieldset class="form-group col-md-6">
                                <b>Birthday</b>
                                <p>{{ date('d F Y', strtotime($user->birthday)) }}</p>
                            </fieldset>

                            <fieldset class="form-group col-md-6">
                                <b>Address</b>
                                <p>{{ $user->address }}</p>
                            </fieldset>
                        </div>
                        <hr>
                        <div class="form-row">
                            <fieldset class="form-group col-md-6">
                                <a class="btn btn-secondary" href="{{ route('user.department') }}">Back</a>
                            </fieldset>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
