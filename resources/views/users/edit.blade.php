@extends('layouts.app')

@section('content')

    <div class="d-flex justify-content-center" style="margin-top: 200px">
    <form method="POST" action="{{route('users.update', $user->id)}}" style="width:300px">
        {{ method_field('PUT') }}
        {{ csrf_field() }}
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Email address</label>
            <input class="form-control" type="text" value="{{$user->email}}" aria-label="readonly input example" readonly>
            <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
        </div>
        <div class="mb-3">
            <label for="exampleInputPassword1" class="form-label">Name</label>
            <input type="text" class="form-control" name="name" id="name" value="{{$user->name}}">
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
    </div>
@endsection
