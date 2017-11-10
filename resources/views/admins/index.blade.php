@extends('layouts.app')
@section('title', 'Employees Manager')

@section('content')
    <div class="container">
        <div class="row">
            @include('admins/breadcrumb')
            @include('shared/alert')
            <a href="{{ route('admin.create') }}" class="btn btn-success create"><i class="fa fa-user-plus" aria-hidden="true"></i> Create User</a>
            <div class="input-group col-md-6">
                <input type="text" class="form-control" id="search_box" name="search" placeholder="Search...">
                <div class="input-group-addon"><i class="fa fa-search" aria-hidden="true"></i></div>
            </div>
            <div class="search_response col-md-12"></div>
            <table class="table table-hover table-bordered">
                <thead class="thead-dark">
                    <tr>
                        <th>#</th>
                        <th>User Name</th>
                        <th>Email</th>
                        <th>Created at</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($users as $user)
                        <tr>
                            <td></td>
                            <td><a href="{{ route('admin.show', ['id' => $user->id]) }}">{{ $user->username }}</a></td>
                            <td>{{ $user->email }}</td>
                            <td class="text-center">{{ date('h:i a | d/m/Y', strtotime($user->created_at)) }}</td>
                            <td>
                                @if($user->deleted_at)
                                <p class="text-danger">Locked</p>
                                @else
                                <p class="text-success">Active</p>
                                @endif
                            </td>
                            <td>
                                <div class="action">
                                    <a href="{{route('admin.edit', ['id' => $user->id])}}" class="btn btn-primary"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</a>
                                    <a href="#" class="btn btn-danger" data-toggle="modal" data-target="#deleteModal" id="deleteUser"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete</a>
                                    <input type="hidden" id="userId" value="{{$user->id}}">
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            {{ $users->links('vendor.pagination.bootstrap-4') }}
        </div>
        @include('admins.delete_modal')
    </div>
@endsection
