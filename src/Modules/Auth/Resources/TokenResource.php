<?php

namespace Modules\Auth\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Laravel\Sanctum\NewAccessToken;

class TokenResource extends JsonResource
{
    /**
     * @return  array<string, array<int, string>>
     */
    public function toArray($request): array
    {
        /** @var NewAccessToken $token */
        $token = $this;

        return [
            'token' => $token->plainTextToken,
        ];
    }
}
