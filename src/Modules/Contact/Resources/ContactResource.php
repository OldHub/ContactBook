<?php

namespace Modules\Contact\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Modules\Contact\Models\Contact;

class ContactResource extends JsonResource
{
    /**
     * @return  array<string, mixed>
     */
    public function toArray($request): array
    {
        /** @var Contact $contact */
        $contact = $this;

        return [
            'id'         => $contact->id,
            'name'       => $contact->name,
            'phone'      => $contact->phone,
            'isFavorite' => (bool) $contact->favorite,
        ];
    }
}
