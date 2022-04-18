<?php

namespace Modules\Contact\Factories;

use Modules\Contact\Models\Contact;

class ContactFactory
{
    public function create(): Contact
    {
        return new Contact();
    }
}
