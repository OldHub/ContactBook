<?php

namespace Modules\Auth\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ForgotRequest extends FormRequest
{
    /**
     * @return  array<string, array<int, string>>
     */
    public function rules(): array
    {
        return [
            'email' => ['required', 'string', 'email', 'exists:users,email'],
        ];
    }
}
