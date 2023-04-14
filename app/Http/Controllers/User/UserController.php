<?php

declare(strict_types=1);


namespace App\Http\Controllers\User;

use App\Http\Requests\User\CreateRequest;
use App\Http\Requests\User\UpdateRequest;
use App\Models\File;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManagerStatic as Image;

class UserController
{

    public function create (CreateRequest $request)
    {
        User::create([
            $request->input('name'),
            $request->input('email'),
            $request->input('password'),
            $request->input('descriptiom'),
            $request->input('role'),


        ]);
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

    public function profile(int $id)
    {
        $user = User::findOrFail($id);



        $file =  File::where('user_id', $user->id)->first();


        return view('users.profile', compact('user', 'file'));
    }

    public function myProfile()
    {
        $user = Auth::user();
        $userId = $user->id;
        $file =  File::where('user_id', $userId)->first();

        $users = User::all();
        return view('users.myprofile', compact('user', 'file', 'users'));
    }

    public function edit(int $id, UpdateRequest $request)
    {
        $user = User::findOrFail($id);



        return view('users.edit', compact('user', ));
    }

    public function update(int $id, UpdateRequest $request)
    {

        $user = User::findOrFail($id);

        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->description = $request->input('description');
        $user->save();
        if ($request->hasFile('avatar')) {
            $avatar = $request->file('avatar');
            $filename = time().'_'.$avatar->getClientOriginalName();
            $avatar = Image::make($avatar);
            $avatar->save(storage_path('app/public/'.$filename));


            File::updateOrCreate(
                ['user_id' => $user->id],
                ['name' => $filename]
            );
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

        return redirect()->route('users');
    }
}
