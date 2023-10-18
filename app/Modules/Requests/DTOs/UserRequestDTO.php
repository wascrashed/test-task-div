<?php

    namespace App\Modules\Requests\DTOs;

    class UserRequestDTO
    {
        public function __construct(
            public readonly string $name,
            public readonly string $email,
            public readonly string $message,
        )
        {
        }
    }
