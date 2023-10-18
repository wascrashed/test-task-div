<?php

namespace App\Modules\User\Services;

use App\Modules\User\DTOs\LoginDTO;
use App\Modules\User\DTOs\RegisterDTO;
use App\Modules\User\Interfaces\AuthServiceInterface;
use App\Modules\User\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use PhpParser\Node\Expr\Cast\Object_;

class AuthService implements AuthServiceInterface
{
    public function register(RegisterDTO $data): User
    {
        $user = User::create([
            'name' => $data->name,
            'email' => $data->email,
            'password' => Hash::make($data->password),
        ]);
        $user->assignRole('Admin');
        $user->givePermissionTo('edit request');
        return $user;
    }

    public function login(LoginDTO $data): ?array
    {
        if (Auth::attempt(['email' => $data->email, 'password' => $data->password], true)) {
            $user = Auth::user();
            $token = $user->createToken("API TOKEN")->plainTextToken;

            return [
                'user' => $user,
                'access_token' => $token,
            ];
        }

        return null;
    }

}







