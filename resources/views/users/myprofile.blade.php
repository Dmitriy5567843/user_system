@extends('layouts.app')

@section('content')
    <script>
        function loadAvatar(event) {
            var avatarImg = document.getElementById('avatar-img');
            var previewImg = document.getElementById('avatar-preview');
            previewImg.style.display = "block";
            previewImg.src = URL.createObjectURL(event.target.files[0]);
            previewImg.onload = function () {
                URL.revokeObjectURL(previewImg.src);
            };
            avatarImg.style.display = "none";
        }
    </script>


    <div class="container">
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
                                            <img id="avatar-preview" src="#" alt="Avatar Preview" class="mt-3" width="100" style="display:none">
                                        @endif

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



    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
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
                                    <td>{{ $user->description }}</td>
                                    <td class="text-right">
                                        <a href="{{route('users.edit', $user->id)}}" class="btn btn-primary">Edit</a>
                                        {{Form::open(['route' => ['users.delete', $user->id], 'method' => 'delete'])}}
                                        <button type="submit" onclick="confirm('are you sure?')" class="btn btn-danger">
                                            Delete
                                        </button>
                                        {{Form::close()}}
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>



@endsection
