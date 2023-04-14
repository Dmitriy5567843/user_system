@extends('layouts.app')

@section('content')

    <div class="d-flex justify-content-center" style="margin-top: 200px">
        <form method="POST" action="{{route('users.update', $user->id)}}" style="width:300px">
            {{ method_field('PUT') }}
            {{ csrf_field() }}
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Email address</label>
                <input class="form-control" type="text" name="email" id="email" value="{{$user->email}}" >

            </div>
            <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Name</label>
                <input type="text" class="form-control" name="name" id="name" value="{{$user->name}}">
            </div>
            <div class="mb-3">
                <label class="form-label">Role</label>
                <select class="form-select" name="role" id="role">
                    <option value="user" {{ $user->role == 'user' ? 'selected' : '' }}>User</option>
                    <option value="admin" {{ $user->role == 'admin' ? 'selected' : '' }}>Admin</option>
                </select>
            </div>

            <div class="form-group row">
                <label for="description" class="col-md-4 col-form-label text-md-right">{{ __('Описание') }}</label>
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-body">
                            <textarea id="description" name="description" class="form-control" rows="3">{{ $user->description }}</textarea>

                            @error('description')
                            <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>

            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
@endsection
