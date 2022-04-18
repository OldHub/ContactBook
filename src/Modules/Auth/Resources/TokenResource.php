<?php

namespace Modules\Auth\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class TokenResource extends JsonResource
{
    /**
     * @return  array<string, array<int, string>>
     */
    public function toArray($request): array
    {
        return [
            'token' => $this->plainTextToken,
        ];
    }
}
