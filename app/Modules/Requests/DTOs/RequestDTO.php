<?php

    namespace App\Modules\Requests\DTOs;

    class RequestDTO
    {
        public function __construct(
            public readonly string $name,
            public readonly string $email,
            public readonly string $status,
            public readonly string $message,
            public readonly ?string $comment = null,
        )
        {
        }
    }
