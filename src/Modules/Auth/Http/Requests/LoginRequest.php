<?php

namespace Modules\Auth\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
{
    /**
     * @return  array<string, array<int, string>>
     */
    public function rules(): array
    {
        return [
            'password' => ['required', 'string'],
            'email' => ['required', 'string', 'email'],
        ];
    }
}
