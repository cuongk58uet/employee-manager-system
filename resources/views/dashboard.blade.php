@extends('layouts.app')
@section('title', 'Dashboard')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-6 offset-md-6">
                <div class="card">
                    <div class="card-header bg-success text-white">Dashboard</div>

                    <div class="card-body">
                        @include('shared/alert')
                        <p class="text-success">You are logged in as <strong>ADMIN </strong>!</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
