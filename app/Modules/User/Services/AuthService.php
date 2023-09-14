<?php

namespace App\Modules\User\Services;

use App\Modules\User\DTOs\LoginDTO;
use App\Modules\User\DTOs\RegisterDTO;
use App\Modules\User\Interfaces\AuthServiceInterface;
use App\Modules\User\Models\User;
use Illuminate\Support\Facades\Hash;
class AuthService  implements AuthServiceInterface
{
    public function register(RegisterDTO $data): User
    {
        $user = User::create([
            'name' => $data->name,
            'email' => $data->email,
            'password' => Hash::make($data->password),
        ]);

        return $user;
    }

    public function login(LoginDTO $data): User
    {
        return User::query()
        ->where('email', $data->email)
        ->where('password', Hash::make($data->password))
        ->first();
    }
}
