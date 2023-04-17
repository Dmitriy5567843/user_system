@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Create User') }}</div>
                    @if(session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif
                    <div class="card-body">
                        <form method="POST" action="{{ route('users.create') }}" enctype="multipart/form-data">
                            {{ method_field('POST') }}
                            {{ csrf_field() }}


                            <div class="form-group row">
                                <label for="avatar"
                                       class="col-md-4 col-form-label text-md-right">{{ __('Аватар') }}</label>

                                <div class="col-md-6">
                                    <input id="avatar" type="file" name="avatar"
                                           class="form-control " accept="image/*"
                                           onchange="loadAvatar(event)">

                                    @error('avatar')
                                    <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
                                    @enderror

                                    <img id="avatar-preview" src="#" alt="Avatar Preview" class="mt-3" width="100"
                                         style="display:none">


                                </div>
                            </div>


                            <div class="form-group row">
                                <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Имя') }}</label>

                                <div class="col-md-6">
                                    <input id="name" type="text"
                                           class="form-control @error('name') is-invalid @enderror" name="name">

                                    @error('name')
                                    <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="password"
                                       class="col-md-4 col-form-label text-md-right">{{ __('Пароль') }}</label>

                                <div class="col-md-6">
                                    <input id="password" type="password"
                                           class="form-control @error('password') is-invalid @enderror" name="password"
                                           required>

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
                                    >

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
                                            name="role" required>
                                        <option value="user" @if(old('role') == 'user') selected @endif>User</option>
                                        <option value="admin" @if(old('role') == 'admin') selected @endif>Admin</option>
                                    </select>

                                    @error('role')
                                    <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
                                    @enderror
                                </div>
                                </div>


                                <div class="form-group row">
                                    <label for="description"
                                           class="col-md-4 col-form-label text-md-right">{{ __('Описание') }}</label>

                                    <div class="col-md-8">
                                        <div class="card">
                                            <div class="card-body">
                                                <textarea id="description" name="description" class="form-control"
                                                          rows="3">{{ old('description') }}</textarea>

                                                @error('description')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                        </div>
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
