<?php

namespace Modules\Contact\Dto;

use Spatie\DataTransferObject\DataTransferObject;

class UpdateContactDto extends DataTransferObject
{
    public ?string $name;
    public ?string $phone;
}
