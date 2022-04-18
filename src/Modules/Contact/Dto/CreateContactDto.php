<?php

namespace Modules\Contact\Dto;

use Spatie\DataTransferObject\DataTransferObject;

class CreateContactDto extends DataTransferObject
{
    public string $name;
    public string $phone;
}
