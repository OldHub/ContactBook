<?php

namespace Modules\Auth\Dto;

use Spatie\DataTransferObject\DataTransferObject;

class RegisterDto extends DataTransferObject
{
    public string $password;
    public string $email;
    public string $name;
}
