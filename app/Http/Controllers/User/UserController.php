<?php

declare(strict_types=1);


namespace App\Http\Controllers\User;

use App\Http\Requests\User\UpdateRequest;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class UserController
{
    public function index()
    {

       $role =  Auth::user()->role;
       if ($role === 'admin')
       {
           $users = User::paginate(6);
       }

       if ($role === 'user')
       {
           $users = User::where('role' , $role)
               ->paginate(6);
       }




        return view('users.users', compact('users'));
    }

    public function profile(int $id)
    {

        $user = User::findOrFail($id);

        return view('users.profile', compact('user'));
    }

    public function edit(int $id)
    {

        $user = User::findOrFail($id);
        return view('users.edit', compact('user'));
    }

    public function update(int $id, UpdateRequest $request)
    {
        User::where('id', $id)
            ->update([
                'name' => $request->get('name'),
                ]);

        return redirect()->route('profile', compact('id'));
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
