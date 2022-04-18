<?php

namespace Modules\Contact\Resources\Favorite;

use Illuminate\Http\Resources\Json\JsonResource;

class FavoriteResource extends JsonResource
{
    /**
     * @return  array<string, array<int, string>>
     */
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'contactId' => $this->contact_id
        ];
    }
}
