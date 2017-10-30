@extends('layouts.app')
@section('title', 'Employee Detail')

@section('content')
    <div class="container">
        <div class="row">
            @include('users/breadcrumb')
            @include('shared/alert')
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header bg-dark text-white">User Detail</div>
                    <div class="card-body">
                        <fieldset class="form-group">
                            <b>User Name</b>
                            <input type="text" class="form-control" id="username" value="{{ $user->username }}" readonly>
                        </fieldset>
                        <hr>
                        <fieldset class="form-group">
                            <b>Email</b>
                            <input type="text" class="form-control" id="email" value="{{ $user->email }}" readonly>
                        </fieldset>
                        <hr>
                        <fieldset class="form-group">
                            <b>Full Name</b>
                            <input type="text" class="form-control" id="fullname" value="{{ $user->firstname . ' ' . $user->lastname }}" readonly>
                        </fieldset>
                        <hr>
                        <fieldset class="form-group">
                            <b>Gender</b>
                            <input type="text" class="form-control" id="gender" value="{{ $user->gender }}" readonly>
                        </fieldset>
                        <hr>
                        <fieldset class="form-group">
                            <b>Birthday</b>
                            <p>{{ date('d F Y', strtotime($user->birthday)) }}</p>
                        </fieldset>
                        <hr>
                        <fieldset class="form-group">
                            <b>Address</b>
                            <p>{{ $user->address }}</p>
                        </fieldset>
                        <a class="btn btn-secondary" href="{{ route('users') }}">Back</a>
                        <a class="btn btn-primary" href="{{route('user.edit', ['id' => $user->id])}}">Edit</a>
                        <button class="btn btn-danger" data-toggle="modal" data-target="#deleteUser">Delete</button>
                    </div>
                </div>
            </div>
            {{-- Modal delete confirm --}}
            @include('users.delete_modal')
        </div>
    </div>
@endsection
