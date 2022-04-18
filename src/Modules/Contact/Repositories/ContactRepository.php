<?php

namespace Modules\Contact\Repositories;

use Illuminate\Database\Eloquent\Collection;
use Modules\Contact\Models\Contact;
use Modules\User\Models\User;

class ContactRepository
{
    public function save(Contact $contact): void
    {
        $contact->save();
        $contact->refresh();
    }

    public function getByUserAndId(int $userId, int $contactId): ?Contact
    {
        return Contact::query()
            ->where('id', $contactId)
            ->where('user_id', $userId)
            ->first();
    }

    public function getUserList(int $userId): Collection
    {
        return Contact::query()
            ->where('user_id', $userId)
            ->get();
    }

    public function delete(Contact $contact): void
    {
        $contact->delete();
        $contact->refresh();
    }
}
