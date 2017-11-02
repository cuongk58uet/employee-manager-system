@extends('layouts.app')
@section('title', 'Employee Detail')

@section('content')
    <div class="container">
        <div class="row">
            @include('users/breadcrumb')
            @include('shared/alert')
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header bg-dark text-white">User Detail</div>
                    <div class="card-body">
                        <div class="form-row">
                            <fieldset class="form-group col-md-6">
                                <b>User Name</b>
                                <input type="text" class="form-control" id="username" value="{{ $user->username }}" readonly>
                            </fieldset>

                            <fieldset class="form-group col-md-6">
                                <b>Email</b>
                                <input type="text" class="form-control" id="email" value="{{ $user->email }}" readonly>
                            </fieldset>
                        </div>
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
                                <b>Member of Department</b>
                                @if($memberOf)
                                    <input type="text" class="form-control" id="manager" value="{{ $memberOf }}" readonly>
                                @else
                                    <input type="text" class="form-control" id="manager" value="None" readonly>
                                @endif
                            </fieldset>

                            <fieldset class="form-group col-md-6">
                                <b>Manager of Department</b>
                                @if($managerOf)
                                    <input type="text" class="form-control" id="manager" value="{{ $managerOf }}" readonly>
                                @else
                                    <input type="text" class="form-control" id="manager" value="None" readonly>
                                @endif
                            </fieldset>
                        </div>
                        <hr>
                        <div class="form-row">
                            <fieldset class="form-group col-md-6"></fieldset>
                            <fieldset class="form-group col-md-6">
                                <a class="btn btn-secondary" href="{{ route('users') }}">Back</a>
                                <a class="btn btn-primary" href="{{route('user.edit', ['id' => $user->id])}}">Edit</a>
                                <a class="btn btn-danger" href="#" data-toggle="modal" data-target="#deleteUser">Delete</a>
                            </fieldset>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('users.delete_modal')
@endsection
