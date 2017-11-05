@extends('layouts.app')
@section('title', 'Employees Manager')

@section('content')
    <div class="container">
        <div class="row">
            @include('users/breadcrumb')
            @include('shared/alert')
            <form action="{{route('user.reset')}}" method="POST" id="formReset">
                {{ csrf_field() }}
                <input type="hidden" name="list" id="listId">
                <button type="submit" id="resetButton" class="btn btn-success reset"><i class="fa fa-refresh" aria-hidden="true"></i> Reset Password</button>
            </form>

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
                            <td><input type="checkbox" name="userId" value="{{$user->id}}"></td>
                            <td><a href="{{ route('user.show', ['id' => $user->id]) }}">{{ $user->username }}</a></td>
                            <td>{{ $user->email }}</td>
                            <td class="text-center">{{ date('h:i a | d/m/Y', strtotime($user->created_at)) }}</td>
                            <td class="text-center">{{date('h:i a | d/m/Y', strtotime($user->updated_at)) }}</td>
                            <td>
                                <div class="action">
                                   <form action="{{route('user.reset')}}" method="POST" id="formReset">
                                       {{ csrf_field() }}
                                       <input type="hidden" name="list" value="{{$user->id}}">
                                       <button type="submit" class="btn btn-primary"><i class="fa fa-refresh" aria-hidden="true"></i> Reset Password</button>
                                   </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            {{ $users->links('vendor.pagination.bootstrap-4') }}
        </div>
        @include('users.delete_modal')
    </div>
@endsection
