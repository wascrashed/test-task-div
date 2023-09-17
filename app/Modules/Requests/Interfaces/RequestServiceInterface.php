<?php

namespace App\Modules\Requests\Interfaces;

interface RequestServiceInterface
{
    public function getAllRequests($status = null);

    public function createRequest($data);

    public function getRequestById($id);

    public function updateRequest($id, $data);

    public function deleteRequest($id);
}
