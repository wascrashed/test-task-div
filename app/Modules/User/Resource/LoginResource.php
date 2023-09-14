<?php

namespace  App\Http\Modules\User\Resource;

use Illuminate\Http\Resources\Json\JsonResource;

class LoginResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'user' => $this->user,
            'access_token' => $this->access_token,
         ];
    }
}
