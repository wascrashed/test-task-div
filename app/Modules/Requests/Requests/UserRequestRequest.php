<?php

namespace App\Modules\Requests\Requests;

use App\Modules\Requests\DTOs\UserRequestDTO;
use Illuminate\Foundation\Http\FormRequest;

class  UserRequestRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name' => 'required|string',
            'email' => 'required|email',
            'status' => 'nullable|enum',
            'message' => 'required|string',
            'comment' => 'nullable|string',
        ];
    }

    public function toDto(): UserRequestDTO
    {
        return new UserRequestDTO(
            $this->input('name'),
            $this->input('email'),
            $this->input('message'),
        );
    }
}
