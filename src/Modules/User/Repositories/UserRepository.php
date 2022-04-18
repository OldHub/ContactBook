<?php

namespace Modules\User\Repositories;

use Modules\User\Models\User;

class UserRepository
{
    public function save(User $user): void
    {
        $user->save();
        $user->refresh();
    }

    public function getByEmail(string $email): ?User
    {
        return User::query()
            ->where('email', $email)
            ->first();
    }

    public function getByToken(string $token): ?User
    {
        return User::query()
            ->where('remember_token', $token)
            ->first();
    }
}
