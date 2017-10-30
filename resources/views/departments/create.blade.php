@extends('layouts.app')
@section('title', 'Create Department')

@section('content')
    <div class="container">
        <div class="row">
            @include('departments.breadcrumb')
            @include('shared/alert')
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header bg-dark text-white">Create Department</div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('department.create') }}">
                            {{ csrf_field() }}
                            <fieldset class="form-group">
                                <label for="name">Name</label>
                                <input type="text" class="form-control" name="name" id="name" placeholder="Enter department name" required>
                            </fieldset>
                            <fieldset class="form-group">
                                <label for="description">Description</label>
                                <textarea class="form-control" name="description" id="description" rows="3" required></textarea>
                            </fieldset>
                            <button type="submit" class="btn btn-block btn-primary">Create</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
