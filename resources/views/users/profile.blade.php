@extends('layouts.app')

@section('content')
    <div class="card text-center mx-auto" style="width: 500px;">
        <div class="card-header">
            User card #{{$user->id}}
        </div>
        <div class="card-body">
            <div class="mb-3 row">
                <label for="staticEmail" class="col-sm-2 col-form-label">Name</label>
                <div class="col-sm-10">
                    <input type="text" readonly class="form-control-plaintext" id="staticEmail" value="{{$user->name}}">
                </div>
            </div>

            <div class="mb-3 row">
                <label for="staticEmail" class="col-sm-2 col-form-label">Email</label>
                <div class="col-sm-10">
                    <input type="text" readonly class="form-control-plaintext" id="staticEmail" value="{{$user->email}}">
                </div>
            </div>

            <div class="mb-3 row">
                <label for="staticEmail" class="col-sm-2 col-form-label">Role</label>
                <div class="col-sm-10">
                    <input type="text" readonly class="form-control-plaintext" id="staticEmail" value="{{$user->role}}">
                </div>
            </div>
        </div>
        <div class="card-footer text-muted">
            <a href="{{route('users.edit', $user->id)}}" class="btn btn-primary">Edit</a>
            <a href="{{route('users.delete', $user->id)}}" class="btn btn-danger" data-method="delete">Delete</a>
        </div>
    </div>

@endsection
