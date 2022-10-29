<?php

namespace Modules\User\Services;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Modules\Auth\Dto\RegisterDto;
use Modules\User\Constants\UserConstants;
use Modules\User\Factories\UserFactory;
use Modules\User\Models\User;
use Modules\User\Repositories\UserRepository;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpKernel\Exception\UnauthorizedHttpException;

class UserService
{
    public function __construct(
        private UserFactory $factory,
        private UserRepository $repository
    ) {
    }

    public function create(RegisterDto $dto): User
    {
        $user = $this->factory->create();
        $user->fill($dto->toArray());
        $user->password = Hash::make($dto->password);
        $this->repository->save($user);

        return $user;
    }

    public function tryGetByEmail(string $email): User
    {
        $user = $this->repository->getByEmail($email);
        if (!$user) {
            throw new UnauthorizedHttpException('', __('Invalid email or password'));
        }

        return $user;
    }

    public function tryGetByToken(string $token): User
    {
        $user = $this->repository->getByToken($token);
        if (!$user) {
            throw new NotFoundHttpException(__('Not found'));
        }

        return $user;
    }

    public function resetPassword(User $user, string $password): User
    {
        $user->password       = Hash::make($password);
        $user->remember_token = Str::random(UserConstants::REMEMBER_TOKEN_LENGTH);
        $this->repository->save($user);

        return $user;
    }
}
