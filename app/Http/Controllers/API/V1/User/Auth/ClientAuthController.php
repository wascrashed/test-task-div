<?php

namespace App\Http\Controllers\API\V1\User\Auth;

use App\Http\Controllers\Controller;
use App\Http\Responses\ErrorResponse;
use App\Http\Responses\SuccessEmptyResponse;
use App\Http\Responses\SuccessResponse;
use App\Modules\User\Requests\LoginRequest;
use App\Modules\User\Interfaces\AuthServiceInterface;
use App\Modules\User\Requests\RegisterRequest;
use App\Modules\User\Resources\LoginResource;
use App\Modules\User\Resources\UserResource;
use Illuminate\Http\Request;

class ClientAuthController extends Controller
{
    private $authService;

    public function __construct(AuthServiceInterface $authService)
    {
        $this->authService = $authService;
    }

    /**
     * Вход администратора
     *
     * @bodyParam email string required Email администратора. Example: admin@example.com
     * @bodyParam password string required Пароль администратора.
     * @responseFile storage/responses/admin/login.json
     * @responseFile status=401 scenario="Login failed" storage/responses/admin/login-failed.json
     * @responseFile status=422 scenario="Validation failed" storage/responses/admin/validation-failed.json
     * @param LoginRequest $request
     * @return SuccessResponse|ErrorResponse
     */
    public function login(LoginRequest $request): SuccessResponse|ErrorResponse
    {
        $user = $this->authService->login($request->toDTO());

        if ($user) {
            return new SuccessResponse([
                'user' => new LoginResource($user),
                'message' => 'Login success'
            ]);
        }

        return new ErrorResponse(
            message: 'Login failed',
            status: 401
        );
    }

    /**
     * Регистрация администратора
     *
     * @param RegisterRequest $request
     * @return SuccessResponse
     */
    public function register(RegisterRequest $request): SuccessResponse
    {

        $user = $this->authService->register($request->toDTO());

        return new SuccessResponse
        ([
            'user' => new UserResource($user),
            'message' => 'Register success'
        ]);
    }


    /**
     * Выход администратора
     *
     * @responseFile storage/responses/admin/logout.json
     * @authenticated
     * @param Request $request
     * @return SuccessEmptyResponse
     */
    public function logout(Request $request): SuccessEmptyResponse
    {
        $request->user()->tokens()->delete();

        return new SuccessEmptyResponse(
            message: 'Logout success'
        );
    }
}
