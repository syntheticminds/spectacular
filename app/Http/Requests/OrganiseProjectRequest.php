<?php

namespace Spectacular\Core\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OrganiseProjectRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'users' => ['nullable', 'array'],
            'users.*.id' => ['required', 'integer', 'min:0'],
            'users.*.weight' => ['required', 'integer', 'min:0', 'max:255'],
            'features' => ['nullable', 'array'],
            'features.*.id' => ['required', 'integer', 'min:0'],
            'features.*.weight' => ['required', 'integer', 'min:0', 'max:255'],
            'requirements' => ['nullable', 'array'],
            'requirements.*.id' => ['required', 'integer', 'min:0'],
            'requirements.*.feature_id' => ['required', 'integer', 'min:0'],
            'requirements.*.weight' => ['required', 'integer', 'min:0', 'max:255'],
        ];
    }
}
