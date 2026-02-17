<?php

namespace Spectacular\Core\Http\Requests;

use Spectacular\Core\Rules\SluggableName as SluggableNameRule;
use Illuminate\Foundation\Http\FormRequest;

class StoreProjectRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'users' => ['array', 'max:25'],
            'users.*' => ['string'],
            'features' => ['array', 'max:25'],
            'features.*' => ['string'],
            'name' => ['required', 'string', 'max:255', new SluggableNameRule()],
        ];
    }
}
