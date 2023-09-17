<?php

namespace App\Modules\Requests\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Modules\Requests\DTOs\RequestDTO;

class  RequestRequest extends FormRequest
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
            'status' => 'required|in:Active,Resolved',
            'message' => 'required|string',
            'comment' => 'nullable|string',
        ];
    }

    public function toDto(): RequestDTO
    {
        return new RequestDTO(
            $this->input('name'),
            $this->input('email'),
            $this->input('status'),
            $this->input('message'),
            $this->input('comment')
        );
    }
}
