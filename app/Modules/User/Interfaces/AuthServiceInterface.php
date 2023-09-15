<?php

namespace App\Modules\User\Interfaces;

use App\Modules\User\DTOs\LoginDTO;
use App\Modules\User\DTOs\RegisterDTO;
use App\Modules\User\Models\User;

interface AuthServiceInterface
{
    public function register(RegisterDTO $data): User;

    public function login(LoginDTO $data): ?array;
}
