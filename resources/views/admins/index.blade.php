@extends('layouts.app')
@section('title', 'Employees Manager')

@section('content')
    <div class="container">
        <div class="row">
            @include('admins/breadcrumb')
            @include('shared/alert')
            <a href="{{ route('admin.create') }}" class="btn btn-success create"><i class="fa fa-user-plus" aria-hidden="true"></i> Create User</a>
            <table class="table table-hover table-bordered">
                <thead class="thead-dark">
                    <tr>
                        <th>#</th>
                        <th>User Name</th>
                        <th>Email</th>
                        <th>Created at</th>
                        <th>Updated at</th>
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
                            <td class="text-center">{{date('h:i a | d/m/Y', strtotime($user->updated_at)) }}</td>
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
