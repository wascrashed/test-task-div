<?php

namespace App\Modules\User\Requests;

use App\Modules\User\DTOs\LoginDTO;
use App\Modules\User\DTOs\RegisterDTO;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
{

    public function authorize(): bool
    {
        return !auth()->check();
    }


    public function rules(): array
    {
        return [
            'email' => 'required|email',
            'password' => 'required'
        ];
    }
    public function toDTO(): LoginDTO
    {
        return new LoginDTO(
            $this->input('email'),
            $this->input('password')
        );
    }
}
