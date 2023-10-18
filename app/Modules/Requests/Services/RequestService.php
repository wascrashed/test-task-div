<?php

namespace App\Modules\Requests\Services;

use App\Modules\Request\Models\Request;
use App\Modules\Requests\Interfaces\RequestServiceInterface;

class RequestService implements RequestServiceInterface
{
    public function getAllRequests($data)
    {
        $query = new Request;
        if (isset($data['status'])) {
            $query = $query->where('status', $data['status']);
        }
        if (isset($data['startDate'])) {
            $query = $query->whereDate('created_at', '>=', $data['startDate']);
        }

        if (isset($data['endDate'])) {
            $query = $query->whereDate('created_at', '<=', $data['endDate']);
        }

        return $query->paginate();
    }

    public function createRequest($data)
    {
        $request = new Request;
        $request->name = $data['name'];
        $request->email = $data['email'];
        $request->status = 'Active';
        $request->message = $data['comment'];

        $request->save();

        return $request;
    }

    public function getRequestById($id)
    {
        return Request::findOrFail($id);
    }

    public function updateRequest($id, $data)
    {
        $request = Request::findOrFail($id);

        unset($data['message']);
        unset($data['status']);

        $request->name = $data['name'];
        $request->email = $data['email'];
        $request->status = 'Active';
        $request->message = $data['comment'];

        $request->save();

        return $request;
    }

    public function updateRequestStatus($id, $data)
    {
        $request = Request::findOrFail($id);
        $request->status = $data['status'];
        $request->message = $data['message'];

        $request->save();

        return $request;
    }

    public function deleteRequest($id)
    {
        $request = Request::findOrFail($id);
        $request->delete();
    }
}







