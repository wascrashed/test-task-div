<?php

namespace App\Http\Controllers\API\V1\User;

use App\Http\Controllers\Controller;

use App\Http\Responses\ErrorResponse;
use App\Http\Responses\SuccessResponse;
use App\Modules\Requests\Interfaces\RequestServiceInterface;
use App\Modules\Requests\Requests\RequestRequest;
use App\Modules\Requests\Requests\UserRequestRequest;
use App\Modules\Requests\Resources\RequestResource;
use App\Modules\Requests\Services\RequestService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class RequestController extends Controller
{
    public function __construct( private RequestServiceInterface $requestService)
    { }

    /**
     * Получить список всех заявок.
     *
     * @queryParam status string Фильтр по статусу заявки (Active или Resolved).
     * @queryParam start_date date Фильтр по начальной дате создания заявки.
     * @queryParam end_date date Фильтр по конечной дате создания заявки.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function index(Request $request)
    {
        $filteredRequests = $this->requestService->getAllRequests($request);

        return new SuccessResponse([
            'data' => new RequestResource($filteredRequests),
            'message' => 'Requests list'
        ]);
    }
    /**
     * Получить информацию о конкретной заявке.
     *
     * @param int $id ID заявки, которую необходимо отобразить
     * @return JsonResponse
     */
    public function show($id)
    {
         $request = $this->requestService->getRequestById($id);

        if (!$request) {
            return new ErrorResponse([
                'message' => 'Request not found'
            ]);
        }

         return new SuccessResponse([
            'data' => new RequestResource($request),
            'message' => 'Requests info'
        ]);
    }
    /**
     * Создать новую заявку.
     *
     * @bodyParam name string required Имя пользователя.
     * @bodyParam email string required Email пользователя.
     * @bodyParam status string required Статус заявки (Active или Resolved).
     * @bodyParam message string required Сообщение пользователя.
     * @bodyParam comment string nullable Комментарий администратора (только для админов).
     *
     * @param RequestRequest $request
     * @return JsonResponse
     */
    public function store(UserRequestRequest $request)
    {
        $requestData = $request->toDto();

        $createdRequest = $this->requestService->createRequest($requestData);

        return new SuccessResponse
        ([
            'data' => new RequestResource($createdRequest),
            'message' => 'Register success'
        ]);
    }

}

