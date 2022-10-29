<?php

namespace Modules\User\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Modules\User\Models\User;

class UserResource extends JsonResource
{
    /**
     * @return  array<string, array<int, string>>
     */
    public function toArray($request): array
    {
        /** @var User $user */
        $user = $this;

        return [
            'id'    => $user->id,
            'name'  => $user->name,
            'email' => $user->email,
        ];
    }
}
