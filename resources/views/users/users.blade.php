@extends('layouts.app')

@section('content')
    <div class="d-flex justify-content-around align-content-stretch flex-wrap">
    @foreach($users as $user)
            <a href="{{route('profile', $user->id)}}"  style="margin-right: 5px">
    <div class="card text-center mb-2" style="width: 33%;">
        <div class="card-header">
          <p> User card id #{{$user->id}}</p>
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

        @auth

            @if(auth()->user()->role === 'user')
                <div class="d-flex m-1 justify-content-end card-footer text-muted">
                    <a href="{{route('users.edit', $user->id)}}" class="btn btn-primary" style="margin-right: 5px">Edit</a>

                    {{Form::open(['route' => ['users.delete', $user->id], 'method' => 'delete'])}}
                    <button type="submit" onclick="confirm('are you sure?')" class="btn btn-danger">
                        Delete
                    </button>
                    {{Form::close()}}
                </div>
            @endif
        @endauth


    </div>
            </a>
    @endforeach

    </div>
    <div class="d-flex justify-content-center">
        <nav aria-label="Page navigation">
            <ul class="pagination">
                <li class="page-item {{ ($users->currentPage() == 1) ? ' disabled' : '' }}">
                    <a class="page-link" href="{{ $users->url(1) }}">Previous</a>
                </li>
                @for ($i = 1; $i <= $users->lastPage(); $i++)
                    <li class="page-item {{ ($users->currentPage() == $i) ? ' active' : '' }}">
                        <a class="page-link" href="{{ $users->url($i) }}">{{ $i }}</a>
                    </li>
                @endfor
                <li class="page-item {{ ($users->currentPage() == $users->lastPage()) ? ' disabled' : '' }}">
                    <a class="page-link" href="{{ $users->url($users->currentPage()+1) }}">Next</a>
                </li>
            </ul>
        </nav>
    </div>
@endsection
