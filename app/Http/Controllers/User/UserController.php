<?php

declare(strict_types=1);


namespace App\Http\Controllers\User;

use App\DTO\CreateUserDTO;
use App\Http\Requests\User\CreateRequest;
use App\Http\Requests\User\UpdateRequest;
use App\Models\File;
use App\Models\User;
use App\Service\UsersService;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Intervention\Image\ImageManagerStatic as Image;

class UserController
{

    private UsersService $usersService;

    public function __construct(UsersService $usersService)
    {
        $this->usersService = $usersService;
    }

    public function create(CreateRequest $request): RedirectResponse
    {
        $this->usersService->create(
            new CreateUserDTO(
                $request->input('name'),
                $request->input('email'),
                $request->input('password'),
                $request->input('role'),
                $request->input('description')
            )
        );

        if ($request->hasFile('avatar')) {
            $avatar = $request->file('avatar');
            $filename = time().'_'.$avatar->getClientOriginalName();
            $avatar = Image::make($avatar);
            $avatar->save(storage_path('app/public/'.$filename));

            $user = User::where('name', $request->name);

            File::updateOrCreate(
                ['user_id' => $user->first()->id],
                ['name' => $filename]
            );
        }
        return redirect()->back()->with(['success' => "Пользователь $request->name создан успешно"]);
    }

    public function mycontoller(): View
    {
        return view('users.new-users');
    }

    public function index()
    {
        if (Auth::user() === null || Auth::user()->role !== 'admin') {
            $users = User::where('role', 'user')
                ->paginate(6);
        } else {
            $users = User::paginate(6);
        }


        return view('users.users', compact('users'));
    }

    public function profile(int $id): View
    {
        $user = User::findOrFail($id);


        $file = File::where('user_id', $user->id)->first();


        return view('users.profile', compact('user', 'file'));
    }

    public function myProfile()
    {
        $user = Auth::user();
        $userId = $user->id;
        $file = File::where('user_id', $userId)->first();

        $users = User::paginate(6);
        return view('users.myprofile', compact('user', 'file', 'users'));
    }

    public function edit(int $id)
    {
        $user = User::findOrFail($id);
        $userId = $user->id;
        $file = File::where('user_id', $userId)->first();

        return view('users.edit', compact('user','file'));
    }

    public function update($id, UpdateRequest $request)
    {$user = User::findOrFail($id);
        $currentRole = $user->role;

        $createUserDTO = new CreateUserDTO(
            $request->input('name'),
            $request->input('email'),
            $request->input('password'),
            $request->input('role'),
            $request->input('description')
        );

        $this->usersService->update($createUserDTO, $id);

        if ($request->hasFile('avatar')) {
            $avatar = $request->file('avatar');
            $filename = time().'_'.$avatar->getClientOriginalName();
            $avatar = Image::make($avatar);
            $avatar->save(storage_path('app/public/'.$filename));

            $user = User::findOrFail($id);
            File::updateOrCreate(
                ['user_id' => $user->id],
                ['name' => $filename]
            );
        }
        if ($createUserDTO->getRole() === 'admin' && $currentRole !== 'admin') {
            Mail::send('role.car', ['user' => $user], function($message) use ($user) {
                $message->to($user->email, $user->name);
                $message->subject('Изменение роли на Admin');
            });
        }
        return redirect()->back()->with(['success' => 'Информация сохранена успешно!', 'id' => $id]);
    }


    public function delete(int $id)
    {
        if (auth()->user()->id === $id) {
            User::where('id', $id)->delete();

            auth()->logout();
            return redirect()->route('login');
        }

        User::where('id', $id)->delete();

        return redirect()->route('my-profile')->with(['delete_success' => 'Пользователь был удален!',]);
    }
}
