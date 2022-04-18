<?php

namespace Modules\Auth\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Modules\Auth\Dto\LoginDto;
use Modules\Auth\Dto\RegisterDto;
use Modules\Auth\Http\Requests\LoginRequest;
use Modules\Auth\Http\Requests\RegisterRequest;
use Modules\Auth\Resources\TokenResource;
use Modules\Auth\Services\AuthService;
use Modules\User\Resources\UserResource;
use Modules\User\Services\UserService;
use Spatie\DataTransferObject\Exceptions\UnknownProperties;

class AuthController extends Controller
{
    private AuthService $authService;
    private UserService $userService;

    public function __construct(
        AuthService $authService,
        UserService $userService
    )
    {
        $this->authService = $authService;
        $this->userService = $userService;
    }

    /**
     * @throws UnknownProperties
     */
    public function registration(RegisterRequest $request): TokenResource
    {
        $dto = new RegisterDto($request->validated());
        $user = $this->userService->create($dto);
        return TokenResource::make($this->authService->createToken($user));
    }

    /**
     * @throws UnknownProperties
     */
    public function login(LoginRequest $request): TokenResource
    {
        $dto = new LoginDto($request->validated());
        $user = $this->userService->tryGetByEmail($dto->email);
        $this->authService->checkPassword($user->password, $dto->password);
        return TokenResource::make($this->authService->createToken($user));
    }

    public function logout(Request $request): JsonResponse
    {
        $this->authService->logout($request->user()->currentAccessToken());
        return response()->json(['message' => __('Successful')]);
    }

    public function forgot(Request $request): JsonResponse
    {
        $user = $this->userService->tryGetByEmail($request->input('email'));
        $this->authService->forgot($user);
        return response()->json(['message' => __('Email has been sent')]);
    }

    public function checkPassword(Request $request): UserResource
    {
        $user = $this->userService->tryGetByToken($request->input('token'));
        return UserResource::make($user);
    }

    public function resetPassword(Request $request): JsonResponse
    {
        $user = $this->userService->tryGetByToken($request->input('token'));
        $this->userService->resetPassword($user, $request->input('password'));
        return response()->json(['message' => __('Successful')]);
    }
}
