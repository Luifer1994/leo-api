<?php

namespace App\Http\Modules\Users\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Modules\Users\Repositories\UserRepository;
use App\Http\Modules\Users\Requests\ChangePasswordRequest;
use App\Http\Modules\Users\Requests\CreateUserRequest;
use App\Http\Modules\Users\Requests\UpdateUserRequest;
use App\Http\Modules\Users\Services\UserService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class UserController extends Controller
{
    protected $userRepository;
    protected $userService;

    public function __construct(UserRepository $userRepository, UserService $userService)
    {
        $this->userRepository = $userRepository;
        $this->userService    = $userService;
    }

    /**
     * Get all users.
     *
     * @param  Request $request
     * @return JsonResponse
     * @author Luifer Almendrales
     */
    public function index(Request $request): JsonResponse
    {

        try {
            $users = $this->userRepository->getAllUsers($request->all());
            return $this->successResponse($users, 'Usuarios listados con exito!');
        } catch (\Throwable $th) {
            return $this->errorResponse($th->getMessage(), Response::HTTP_BAD_REQUEST);
        }
    }

    /**
     * Create a new user.
     *
     * @param  Request $request
     * @return JsonResponse
     * @author Luifer Almendrales
     */
    public function store(CreateUserRequest $request): JsonResponse
    {

        try {
            $user = $this->userService->register($request);
            if (!$user['res']) {
                return  $this->errorResponse($user['message'], $user['code']);
            }
            return $this->successResponse($user['data'], $user['message'], $user['code']);
        } catch (\Throwable $th) {
            return $this->errorResponse($th->getMessage(), Response::HTTP_BAD_REQUEST);
        }
    }

    /**
     * Update a user.
     *
     * @param  Request $request
     * @param  int $id (user id)
     * @return JsonResponse
     * @author Luifer Almendrales
     */
    public function update(UpdateUserRequest $request, int $id): JsonResponse
    {
        try {
            $user = $this->userService->update($request, $id);
            if (!$user['res']) {
                return  $this->errorResponse($user['message'], $user['code']);
            }
            return $this->successResponse($user['data'], $user['message'], $user['code']);
        } catch (\Throwable $th) {
            return $this->errorResponse('¡El usuario no pudo ser actualizado!', Response::HTTP_BAD_REQUEST);
        }
    }

    /**
     * Change password.
     *
     * @param  ChangePasswordRequest $request
     * @return JsonResponse
     * @author Luifer Almendrales
     */
    public function changePassword(ChangePasswordRequest $request): JsonResponse
    {
        try {
            $user = $this->userService->changePassword($request);
            if (!$user['res']) {
                return  $this->errorResponse($user['message'], $user['code']);
            }
            return $this->successResponse($user['data'], $user['message'], $user['code']);
        } catch (\Throwable $th) {
            return $this->errorResponse('¡La contraseña no pudo ser actualizada!', Response::HTTP_BAD_REQUEST);
        }
    }
}
