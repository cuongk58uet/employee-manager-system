@extends('layouts.app')
@section('title', 'My Profile')

@section('content')
    <div class="container">
        <div class="">
            @include('users/breadcrumb')
            @include('shared/alert')
        @if($memberOf)
            <p>You are a member of: {{ $memberOf->name }}</p>
        @endif
        @if($managerOf)
            <p>You are manager of: <b class="text-success">{{$managerOf->name}}</b></p>

            <h4 class="text-center">Members List</h4>
            @if($members)
                <table class="table table-hover table-bordered">
                    <thead class="thead-dark">
                        <tr>
                            <th>#</th>
                            <th>User Name</th>
                            <th>Email</th>
                            <th>Full Name</th>
                            <th>Created at</th>
                            <th>Updated at</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($members as $member)
                            <tr>
                                <td></td>
                                <td><a href="{{ route('user.member.profile', ['id' => $member->id]) }}">{{ $member->username }}</a></td>
                                <td>{{ $member->email }}</td>
                                <td>{{ $member->firstname . ' ' . $member->lastname }}</td>
                                <td class="text-center">{{ date('h:i a | d/m/Y', strtotime($member->created_at)) }}</td>
                                <td class="text-center">{{date('h:i a | d/m/Y', strtotime($member->updated_at)) }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                {{ $members->links('vendor.pagination.bootstrap-4') }}
                <a href="{{route('csv.export')}}" class="btn btn-success export">Export to CSV</a>
            @else
                <b class="text-warning">Division does not have member yet</b>
            @endif
        @endif
        </div>
    </div>
@endsection
