@extends('layouts.app')

@section('content')


    <div class="d-flex justify-content-around align-content-stretch flex-nowrap">
    <div class="container ">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">'Личный кабинет'</div>

                    <div class="card-body">
                        @if(session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif

                            <form method="POST" action="{{route('users.update', $user->id)}}" style="width:100%"
                                  enctype="multipart/form-data">
                                {{ method_field('PUT') }}
                                {{ csrf_field() }}
                                <div class="form-group row">
                                    <label for="avatar"
                                           class="col-md-4 col-form-label text-md-right">{{ __('Аватар') }}</label>

                                    <div class="col-md-6">
                                        <input id="avatar" type="file" name="avatar"
                                               class="form-control @error('avatar') is-invalid @enderror" accept="image/*"
                                               onchange="loadAvatar(event)">

                                        @error('avatar')
                                        <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
                                        @enderror
                                        @if (isset($file->name))
                                            <img id="avatar-img" src="{{ $user->avatar_url ?? asset('storage/' . $file->name) }}"
                                                 alt="Avatar" class="mt-3" width="100">
                                        @endif
                                        <img id="avatar-preview" src="#" alt="Avatar Preview" class="mt-3" width="100" style="display:none">
                                    </div>
                                </div>



                            <div class="form-group row">
                                <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Имя') }}</label>

                                <div class="col-md-6">
                                    <input id="name" type="text"
                                           class="form-control @error('name') is-invalid @enderror" name="name"
                                           value="{{ $user->name }}" required autocomplete="name" autofocus>

                                    @error('name')
                                    <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                    @enderror
                                </div>
                            </div>

                                <div class="form-group row">
                                    <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Пароль') }}</label>
                                    <div class="col-md-6">
                                        <input id="password" type="text"
                                               class="form-control @error('password') is-invalid @enderror"
                                               name="password"
                                               value="введите новый пароль"
                                               required autocomplete="name"
                                               autofocus
                                               onfocus="this.value=''">

                                        @error('password')
                                        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
                                        @enderror
                                    </div>
                                </div>

                            <div class="form-group row">
                                <label for="email"
                                       class="col-md-4 col-form-label text-md-right">{{ __('E-Mail') }}</label>

                                <div class="col-md-6">
                                    <input id="email" type="email"
                                           class="form-control @error('email') is-invalid @enderror" name="email"
                                           value="{{ $user->email }}" required autocomplete="email">

                                    @error('email')
                                    <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="description" class="col-md-4 col-form-label text-md-right">{{ __('Описание') }}</label>

                                <div class="col-md-6">
                                    <textarea id="description" name="description" class="form-control">{{ $user->description }}</textarea>

                                    @error('description')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                     </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Сохранить') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>


@if( $user->role === 'admin')
    <div class="container w-100" >
        @if(session('delete_success'))
            <div class="alert alert-success">
                {{ session('delete_success') }}
            </div>
        @endif
        <div class="row justify-content-center " >
            <div class="col-md-8 ">
                <div class="card ">
                    <div class="card-header d-flex justify-content-between align-items-center ">
                        Список пользователей
                        <a href="{{ route('new-users') }}" class="btn btn-primary ml-auto">Создать пользователя</a>
                    </div>

                    <div class="card-body">
                        <table class="table">
                            <thead>
                            <tr>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Role</th>
                                <th>Description</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($users as $user)
                                <tr>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>{{ $user->role }}</td>
                                    <td>
                                        <div class="form-group">
                                            <textarea class="form-control" rows="3" name="description" readonly>{{ $user->description }}</textarea>
                                        </div>
                                    </td>
                                    <td class="text-right">
                                        <a href="{{route('users.edit', $user->id)}}" class="btn btn-primary">Edit</a>

                                        {{ Form::open(['route' => ['users.delete', $user->id], 'method' => 'delete']) }}
                                        <button type="submit" onclick="return confirm('Are you sure you want to delete this user?');" class="btn btn-danger">
                                            Delete
                                        </button>
                                        {{ Form::close() }}
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        <div class="d-flex justify-content-center">
                            <nav aria-label="Page navigation">
                                <ul class="pagination">
                                    <li class="page-item {{ ($users->currentPage() == 1) ? ' disabled' : '' }}">
                                        <a class="page-link" href="{{ $users->url(1) }}" aria-label="Previous">
                                            <span aria-hidden="true">&laquo;</span>
                                            <span class="sr-only">Previous</span>
                                        </a>
                                    </li>
                                    @for ($i = 1; $i <= $users->lastPage(); $i++)
                                        <li class="page-item {{ ($users->currentPage() == $i) ? ' active' : '' }}">
                                            <a class="page-link" href="{{ $users->url($i) }}">{{ $i }}</a>
                                        </li>
                                    @endfor
                                    <li class="page-item {{ ($users->currentPage() == $users->lastPage()) ? ' disabled' : '' }}">
                                        <a class="page-link" href="{{ $users->url($users->currentPage()+1) }}" aria-label="Next">
                                            <span aria-hidden="true">&raquo;</span>
                                            <span class="sr-only">Next</span>
                                        </a>
                                    </li>
                                </ul>
                            </nav>
                        </div>
                    </div>

                </div>
            </div>
        </div>

    </div>


        @endif
    </div>



@endsection
