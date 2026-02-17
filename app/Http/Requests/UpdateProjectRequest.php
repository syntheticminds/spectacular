<?php

namespace App\Http\Requests;

use App\Rules\SluggableName as SluggableNameRule;
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
