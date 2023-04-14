@extends('layouts.app')

@section('content')

    <div class="d-flex justify-content-center" style="margin-top: 200px">
        <form method="POST" action="{{route('users.update', $user->id)}}" style="width:300px">
            {{ method_field('PUT') }}
            {{ csrf_field() }}
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Email address</label>
                <input class="form-control" type="text" value="{{$user->email}}" aria-label="readonly input example"
                       readonly>
                <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
            </div>
            <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Name</label>
                <input type="text" class="form-control" name="name" id="name" value="{{$user->name}}">
            </div>
            <div class="mb-3">
                <label class="form-label">Role</label>
                <input type="text" class="form-control" name="Role" id="Role" value="{{$user->role}}">
            </div>

            <div class="form-group row">
                <label for="description" class="col-md-4 col-form-label text-md-right">{{ __('Описание') }}</label>
                <div class="container">
                <div class="col-md-8">
                <div class="col-md-6">
                    <div class="card">
                    <textarea id="description" name="description"
                              class="form-control">{{ $user->description }}</textarea>

                    @error('description')
                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                     </span>
                    @enderror
                </div>
            </div></div></div></div>

            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
@endsection
