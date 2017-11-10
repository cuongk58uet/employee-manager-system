@extends('layouts.app')
@section('title', 'Edit Department')

@section('content')
    <div class="container">
        <div class="row">
            <ol class="breadcrumb container-fluid">
              <li class="breadcrumb-item">
                <a href="{{ route('dashboard') }}">Dashboard</a>
              </li>
              <li class="breadcrumb-item active">Departments</li>
            </ol>
            @include('shared/alert')
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header bg-success text-white">Edit Department</div>
                    <div class="card-body">
                        <form action="{{ route('department.update') }}" method="POST">
                            {{ csrf_field() }}
                            <input type="hidden" name="id" value="{{ $department->id }}">
                            <fieldset class="form-group">
                                <b for="departmentName">Department Name</b>
                                <input type="text" name="name" class="form-control" id="name" value="{{ $department->name }}">
                            </fieldset>
                            <fieldset class="form-group">
                                <b>Description: </b>
                                <textarea class="form-control" name="description" id="description" rows="3">{{ $department->description }}</textarea>
                            </fieldset>
                            <a class="btn btn-dark" href="{{ route('departments') }}">Cancel</a>
                            <button class="btn btn-success" type="submit">Save change</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
