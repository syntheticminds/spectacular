<?php

namespace Spectacular\Core\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUnknownRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
        ];
    }
}
