@extends('layouts.app')
@section('title', 'Departments Manager')

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
            <a href="{{ route('department.create') }}" class="btn btn-success create"><i class="fa fa-plus" aria-hidden="true"></i> Create Department</a>
            <table class="table table-hover table-bordered">
                <thead class="thead-dark">
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Created at</th>
                        <th>Updated at</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($departments as $department)
                        <tr>
                            <td></td>
                            <td><a href="{{ route('department.show', ['id' => $department->id]) }}">{{ $department->name }}</a></td>
                            <td class="text-center">{{ date('H:i a | d/m/Y', strtotime($department->created_at)) }}</td>
                            <td class="text-center">{{ date('H:i a | d/m/Y', strtotime($department->updated_at)) }}</td>
                            <td>
                                <div class="departmentAction">
                                    <a href="{{route('department.edit', ['id' => $department->id])}}" class="btn btn-primary">Edit</a>
                                    <a class="btn btn-danger" href="#" data-toggle="modal" data-target="#deleteModal" id="deleteDepartment">Delete</a>
                                    <input type="hidden" id="departmentId" value="{{$department->id}}">
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            {{ $departments->links('vendor.pagination.bootstrap-4') }}
        </div>
        @include('departments.delete_modal')
    </div>
@endsection
