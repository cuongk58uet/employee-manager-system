@extends('layouts.app')
@section('title', 'Dashboard')

@section('content')
    <div class="container">
        <div class="row">
            @include('shared/alert')
            @include('shared/information')
        </div>
    </div>
@endsection
