<?php

namespace App\Http\Controllers;

use App\Dtos\UserDto;
use App\Http\Requests\User\UserStoreRequest;
use App\Http\Requests\User\UserUpdateRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use App\Repositories\UserRepository;

class UserController extends Controller
{
    public function __construct(private readonly UserRepository $repository) {}

    public function store(UserStoreRequest $request)
    {
        $dto = UserDto::fromRequest($request);

        $this->repository->create($dto);

        return response()->noContent();
    }

    public function show(User $user)
    {
        // Todo: Support converting currency

        return new UserResource($user);
    }

    public function update(UserUpdateRequest $request, User $user)
    {
        $dto = UserDto::updateFromRequest($request, $user);

        $this->repository->update($user, $dto);
    }

    public function destroy(User $user)
    {
        $this->repository->delete($user);

        return response()->noContent();
    }
}
