<?php

namespace Modules\Contact\Resources\Favorite;

use Illuminate\Http\Resources\Json\JsonResource;
use Modules\Contact\Models\Favorite;

class FavoriteResource extends JsonResource
{
    /**
     * @return  array<string, array<int, string>>
     */
    public function toArray($request): array
    {
        /** @var Favorite $favorite */
        $favorite = $this;

        return [
            'id'        => $favorite->id,
            'contactId' => $favorite->contact_id,
        ];
    }
}
