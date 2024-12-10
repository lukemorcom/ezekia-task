<?php

namespace App\Http\Controllers;

use App\Dtos\UserDto;
use App\Http\Requests\UserStoreRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use App\Repositories\UserRepository;
use Illuminate\Http\Request;

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

    public function update(Request $request, User $user)
    {
        //
    }

    public function destroy(User $user)
    {
        //
    }
}
