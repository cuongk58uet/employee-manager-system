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
                                    <input type="email" name="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" id="email" value="{{ $user->email }}" required>
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
                                    <input type="text" name="firstname" class="form-control{{ $errors->has('firstname') ? ' is-invalid' : '' }}" id="firstname" value="{{ $user->firstname }}" required>
                                    @if ($errors->has('firstname'))
                                        <div class="invalid-feedback">
                                            {{ $errors->first('firstname') }}
                                        </div>
                                    @endif
                                </fieldset>
                                <fieldset class="form-group col-md-6">
                                    <b>Last Name</b>
                                    <input type="text" name="lastname" class="form-control{{ $errors->has('lastname') ? ' is-invalid' : '' }}" id="lastname" value="{{ $user->lastname }}" required>
                                    @if ($errors->has('lastname'))
                                        <div class="invalid-feedback">
                                            {{ $errors->first('lastname') }}
                                        </div>
                                    @endif
                                </fieldset>
                            </div>

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
                                <fieldset>
                                    <b>Date of birth: </b>
                                    <input type="date" class="form-control" name="birthday" value="{{$user->birthday}}">
                                </fieldset>
                            </div>
                            <hr>
                            <div class="form-row">
                                <fieldset class="form-group col-md-6">
                                    <b>Member of Department:</b>
                                    <select class="form-control{{ $errors->has('member') ? ' is-invalid' : '' }}" name="member" id="member" required>
                                        <option value="0">None</option>
                                        @foreach($departments as $department)
                                            @if($departmentId && $department->id == $departmentId)
                                                <option selected value="{{ $department->id }}">{{ $department->name }}</option>
                                            @else
                                                <option value="{{ $department->id }}">{{ $department->name }}</option>
                                            @endif
                                        @endforeach
                                        @if ($errors->has('member'))
                                            <div class="invalid-feedback">
                                                {{ $errors->first('member') }}
                                            </div>
                                        @endif
                                    </select>
                                </fieldset>
                                <fieldset class="form-group col-md-6">
                                    <b>Manager of Department:</b>
                                    <select class="form-control{{ $errors->has('manager') ? ' is-invalid' : '' }}" name="manager" id="manager" required>
                                        <option value="0">None</option>
                                        @foreach($departments as $department)
                                            @if($managerDepartmentId && $department->id == $managerDepartmentId)
                                                <option selected value="{{ $department->id }}">{{ $department->name }}</option>
                                            @else
                                                <option value="{{ $department->id }}">{{ $department->name }}</option>
                                            @endif
                                        @endforeach
                                        @if ($errors->has('manager'))
                                            <div class="invalid-feedback">
                                                {{ $errors->first('manager') }}
                                            </div>
                                        @endif
                                    </select>
                                </fieldset>
                            </div>
                            <a class="btn btn-secondary" href="{{ route('users') }}">Cancel</a>
                            <button type="submit" class="btn btn-success" id="editUser">Save change</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
