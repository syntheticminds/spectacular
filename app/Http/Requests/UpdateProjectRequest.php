<?php

namespace Spectacular\Core\Http\Requests;

use Spectacular\Core\Rules\SluggableName as SluggableNameRule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateProjectRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'description' => ['nullable', 'string'],
            'name' => ['sometimes', 'string', 'max:255', new SluggableNameRule()],
        ];
    }
}
