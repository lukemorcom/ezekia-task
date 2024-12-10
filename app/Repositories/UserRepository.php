<?php

namespace App\Repositories;

use App\Dtos\UserDto;
use App\Models\User;

class UserRepository
{
    public function create(UserDto $dto): User
    {
        return User::create($dto->toArray());
    }

    public function delete(User $user): void
    {
        $user->delete();
    }
}
