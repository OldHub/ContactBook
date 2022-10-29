<?php

namespace Modules\User\Factories;

use Illuminate\Support\Str;
use Modules\User\Constants\UserConstants;
use Modules\User\Models\User;

class UserFactory
{
    public function create(): User
    {
        $user = new User();

        $user->remember_token = Str::random(UserConstants::REMEMBER_TOKEN_LENGTH);

        return $user;
    }
}
