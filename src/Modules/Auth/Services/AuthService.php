<?php

namespace Modules\Auth\Services;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Laravel\Sanctum\NewAccessToken;
use Laravel\Sanctum\PersonalAccessToken;
use Modules\Auth\Jobs\SendEmailJob;
use Modules\User\Models\User;
use Symfony\Component\HttpKernel\Exception\UnauthorizedHttpException;

class AuthService
{
    public function createToken(User $user): NewAccessToken
    {
        return $user->createToken(Str::random(10));
    }

    public function checkPassword(string $userPassword, string $inputPassword): void
    {
        if (!Hash::check($inputPassword, $userPassword)) {
            throw new UnauthorizedHttpException('', __('Invalid email or password'));
        }
    }

    public function logout(PersonalAccessToken $token): void
    {
        $token->delete();
    }

    public function forgot(User $user): void
    {
        SendEmailJob::dispatch($user);
    }
}
