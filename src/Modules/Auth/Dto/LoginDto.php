<?php

namespace Modules\Auth\Dto;

use Spatie\DataTransferObject\DataTransferObject;

class LoginDto extends DataTransferObject
{
    public string $password;
    public string $email;
}
