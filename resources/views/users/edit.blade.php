@extends('layouts.app')

@section('content')
    <div class="d-flex justify-content-around align-content-stretch flex-nowrap">
        <div class="container ">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header">Личный кабинет {{$user->name}}</div>

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
                                    <label for="role" class="col-md-4 col-form-label text-md-right">{{ __('Роль') }}</label>
                                    <div class="col-md-6">
                                        <select id="role" class="form-control @error('role') is-invalid @enderror"
                                                name="role" required autocomplete="role">
                                            <option value="user" @if(old('role', $user->role) === 'user') selected @endif>User</option>
                                            <option value="admin" @if(old('role', $user->role) === 'admin') selected @endif>Admin</option>
                                        </select>

                                        @error('role')
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
@endsection
