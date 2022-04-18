<?php

namespace Modules\Contact\Services\Favorite;

use Modules\Contact\Models\Contact;

class FavoriteService
{
    public function add(Contact $contact): void
    {
        $contact->favorite()->firstOrCreate();
    }

    public function delete(Contact $contact): void
    {
        $contact->favorite->delete();
    }
}
