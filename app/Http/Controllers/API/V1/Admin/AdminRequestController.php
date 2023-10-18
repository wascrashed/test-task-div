<?php

namespace App\Http\Controllers\API\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Responses\SuccessResponse;
use App\Modules\Requests\Interfaces\RequestServiceInterface;
use App\Modules\Requests\Requests\RequestRequest;
use App\Modules\Requests\Resources\RequestResource;
use Illuminate\Http\JsonResponse;

class AdminRequestController extends Controller
{

    public function __construct(private RequestServiceInterface $requestService)
    {
    }


    /**
     * Обновить заявку администратором.
     *
     * @bodyParam name string required Имя пользователя.
     * @bodyParam email string required Email пользователя.
     * @bodyParam status string required Статус заявки (Active или Resolved).
     * @bodyParam message string required Сообщение пользователя.
     * @bodyParam comment string nullable Комментарий администратора (только для админов).
     *
     * @param RequestRequest $request
     * @param int $id ID заявки, которую необходимо обновить
     * @return JsonResponse
     */
    public function update(RequestRequest $request, $id)
    {
        $requestData = $request->toDto();
        $updatedRequest = $this->requestService->updateRequest($id, $requestData);
        return new SuccessResponse
        ([
            'data' => new RequestResource($updatedRequest),
            'message' => 'Request updated successfully'
        ]);
    }

    /**
     * Удалить заявку администратором.
     *
     * @param int $id ID заявки, которую необходимо удалить
     * @return JsonResponse
     */
    public function destroy($id)
    {
        $this->requestService->deleteRequest($id);

        return new SuccessResponse(['message' => 'Request deleted successfully']);
    }
}

