<?php

namespace App\Modules\User\DTOs;

class LoginDTO
{
    public function __construct(
        public readonly string $email,
        public readonly string $password,
    )
    {
    }
}
