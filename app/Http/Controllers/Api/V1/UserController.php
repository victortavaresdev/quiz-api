<?php

namespace App\Http\Controllers\Api\V1;

use App\DTO\User\CreateUserDTO;
use App\DTO\User\UpdateUserDTO;
use App\Http\Controllers\Controller;
use App\Http\Requests\User\StoreUserRequest;
use App\Http\Requests\User\UpdateUserRequest;
use App\Http\Resources\User\UserResource;
use App\Models\User;
use App\Services\User\UserService;

/**
 * @group User endpoints
 */
class UserController extends Controller
{
    public function __construct(
        protected UserService $userService
    ) {
    }

    /**
     * POST User
     *
     * Create a new user.
     *
     * @response 201 {"message":"Created"}
     * @response 400 {"message": "Bad Request"}
     * @response 409 {"message": "Conflict"}
     */
    public function store(StoreUserRequest $request): UserResource
    {
        $dto = CreateUserDTO::fromRequest($request);
        $user = $this->userService->store($dto);

        return new UserResource($user);
    }

    /**
     * GET User
     *
     * Get user data.
     *
     * @response {"message":"OK"}
     * @response 404 {"message": "Not Found"}
     */
    public function show(User $user): UserResource
    {
        return new UserResource($user);
    }

    /**
     * PUT User
     *
     * Update user data.
     *
     * @authenticated
     *
     * @response {"message":"OK"}
     * @response 400 {"message": "Bad Request"}
     * @response 401 {"message": "Unauthenticated"}
     * @response 403 {"message": "Forbidden"}
     * @response 404 {"message": "Not Found"}
     */
    public function update(User $user, UpdateUserRequest $request): UserResource
    {
        $this->authorize('update', $user);

        $dto = UpdateUserDTO::fromRequest($request);
        $updatedUser = $this->userService->update($user, $dto);

        return new UserResource($updatedUser);
    }

    /**
     * DELETE User
     *
     * Delete user data.
     *
     * @authenticated
     *
     * @response {"message":"OK"}
     * @response 401 {"message": "Unauthenticated"}
     * @response 403 {"message": "Forbidden"}
     * @response 404 {"message": "Not Found"}
     */
    public function destroy(User $user): void
    {
        $this->authorize('delete', $user);
        $this->userService->destroy($user);
    }
}
