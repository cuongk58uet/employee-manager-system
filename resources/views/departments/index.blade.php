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
            <table class="table table-hover table-bordered">
                <thead class="thead-dark">
                    <tr>
                        <th>Name</th>
                        <th>Created at</th>
                        <th>Updated at</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($departments as $department)
                        <tr>
                            <td><a href="{{ route('department.show', ['id' => $department->id]) }}">{{ $department->name }}</a></td>
                            <td>{{ date('d F Y', strtotime($department->created_at)) }}</td>
                            <td>{{ date('d F Y', strtotime($department->updated_at)) }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            {{ $departments->links('vendor.pagination.bootstrap-4') }}
        </div>
    </div>
@endsection
