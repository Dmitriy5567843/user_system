<?php

namespace App\Service;

use App\DTO\CreateUserDTO;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UsersService
{
    public function create(CreateUserDTO $createUserDTO)
    {
        return User::create([
            'name' => $createUserDTO->getName(),
            'email' => $createUserDTO->getEmail(),
            'password' => Hash::make($createUserDTO->getPassword()),
            'role' => $createUserDTO->getRole(),
            'description' => $createUserDTO->getDescription(),
        ]);
    }

    public function update(CreateUserDTO $createUserDTO, $id,)
    {
        $user = User::findOrFail($id);

         User::where('id', $id)->update([
            'name' => $createUserDTO->getName(),
            'email' => $createUserDTO->getEmail(),
            'password' => Hash::make($createUserDTO->getPassword()),
            'role' => $createUserDTO->getRole() ?? $user->role,
            'description' => $createUserDTO->getDescription(),
        ]);

         return User::where('id', $id)->first();

    }
}
