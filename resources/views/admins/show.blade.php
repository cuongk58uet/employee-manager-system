@extends('layouts.app')
@section('title', 'Employee Detail')

@section('content')
    <div class="container">
        <div class="row">
            @include('admins/breadcrumb')
            @include('shared/alert')
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header bg-info text-white">Employee Detail</div>
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
                                <a class="btn btn-secondary" href="{{ route('admins') }}">Back</a>
                                <a class="btn btn-primary" href="{{route('admin.edit', ['id' => $user->id])}}">Edit</a>
                                <a class="btn btn-danger" href="#" data-toggle="modal" data-target="#deleteUser" id="deleteUser">Delete</a>
                            </fieldset>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('admins.delete_modal')
@endsection
