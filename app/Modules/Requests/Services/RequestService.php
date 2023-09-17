<?php

namespace App\Modules\Requests\Services;

use App\Modules\Request\Models\Request;
use App\Modules\Requests\Interfaces\RequestServiceInterface;
use App\Modules\Requests\DTOs\RequestDTO;

class RequestService implements RequestServiceInterface
{
    public function getAllRequests($request)
    {
        return Request::scopeFilterByStatus($request);
    }

    public function createRequest($data)
    {
        return Request::create($data);
    }

    public function getRequestById($id)
    {
        return Request::findOrFail($id);
    }

    public function updateRequest($id, $data)
    {
        $request = Request::findOrFail($id);
        $request->update($data);

        return $request;
    }

    public function deleteRequest($id)
    {
        $request = Request::findOrFail($id);
        $request->delete();
    }
}







