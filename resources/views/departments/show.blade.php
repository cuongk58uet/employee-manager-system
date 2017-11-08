@extends('layouts.app')
@section('title', 'Department Detail')

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
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header bg-dark text-white">Department Detail</div>
                    <div class="card-body">
                        <fieldset class="form-group">
                            <b for="departmentName">Department Name</b>
                            <input type="text" class="form-control" id="name" value="{{ $department->name }}" readonly>
                        </fieldset>
                        <hr>
                        <fieldset class="form-group">
                            <b for="description">Description</b>
                            <p class="text-justify">{{ $department->description }}</p>
                        </fieldset>
                        <a class="btn btn-secondary" href="{{ route('departments') }}">Back</a>
                        <a class="btn btn-primary" href="{{route('department.edit', ['id' => $department->id])}}">Edit</a>
                        <button class="btn btn-danger" data-toggle="modal" data-target="#deleteDepartment">Delete</button>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <h5><b>Manager of department:</b></h5>
                @if ($manager)
                    <b><a href="{{route('admin.show', ['id' => $manager->id])}}">{{ $manager->firstname . ' ' . $manager->lastname }}</a></b>
                @endif

                <h6><b>Members:</b></h6>
                <ol>
                    @foreach ($members as $member)
                            <li><a href="{{ route('admin.show', ['id' => $member->id]) }}">{{ $member->firstname . ' ' . $member->lastname }}</a></li>
                    @endforeach
                </ol>
            </div>
            {{-- Modal delete confirm --}}
            <div class="modal fade" id="deleteDepartment" tabindex="-1" role="dialog" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h6 class="modal-title" id="exampleModalLabel"><b>Ready to delete?</b></h6>
                            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>
                        <div class="modal-body">Click "Delete" below if you are ready delete this department.</div>
                        <div class="modal-footer">
                            <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                            <form method="POST" action="{{ route('department.delete') }}">
                                <input type="hidden" name="_token" value="{{csrf_token() }}">
                                <input type="hidden" name="id" value="{{ $department->id }}">
                                <div>
                                    <button type="submit" class="btn btn-danger" id="confirmDelete">Delete</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
