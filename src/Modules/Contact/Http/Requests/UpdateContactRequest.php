<?php

namespace Modules\Contact\Http\Requests;

use App\Validation\Rules\PhoneRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Unique;

class UpdateContactRequest extends FormRequest
{
    /**
     * @return  array<string, array<int, PhoneRule|Unique|string>>
     */
    public function rules(): array
    {
        return [
            'name'  => ['nullable', 'string', 'max:255', 'required_without:phone'],
            'phone' => [
                'nullable',
                'string',
                Rule::unique('contacts')->ignore($this->phone, 'phone'),
                new PhoneRule(),
                'required_without:name',
            ],
        ];
    }
}
