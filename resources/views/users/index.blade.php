@extends('layouts.app')
@section('title', 'Employees Manager')

@section('content')
    <div class="container">
        <div class="row">
            @include('users/breadcrumb')
            @include('shared/alert')
            <table class="table table-hover table-bordered">
                <thead class="thead-dark">
                    <tr>
                        <th>User Name</th>
                        <th>Created at</th>
                        <th>Updated at</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($users as $user)
                        <tr>
                            <td><a href="{{ route('user.show', ['id' => $user->id]) }}">{{ $user->username }}</a></td>
                            <td>{{ date('d F Y', strtotime($user->created_at)) }}</td>
                            <td>{{ date('d F Y', strtotime($user->updated_at)) }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            {{ $users->links('vendor.pagination.bootstrap-4') }}
        </div>
    </div>
@endsection
