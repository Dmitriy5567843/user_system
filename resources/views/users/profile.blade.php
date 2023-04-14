@extends('layouts.app')

@section('content')
    <div class="card text-center mx-auto" style="width: 500px;">
        <div class="card-header">
            User card #{{$user->id}}
        </div>
        <div class="form-group row">
            <label for="avatar"
                   class="col-md-4 col-form-label text-md-right">{{ __('Avatar') }}</label>

            <div class="col-md-6">

                @if (isset($file->name))
                    <img id="avatar-img" src="{{ $user->avatar_url ?? asset('storage/' . $file->name) }}"
                         alt="Avatar" class="mt-3" width="100">
                @endif
            </div>
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
    </div>



@endsection
