<?php

namespace Spectacular\Core\Http\Requests;

use Spectacular\Core\Rules\QuarterHour as QuarterHourRule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateTaskRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => ['sometimes', 'required', 'string', 'max:255'],
            'estimate' => ['sometimes', 'nullable', 'numeric', new QuarterHourRule()],
            'is_complete' => ['sometimes', 'required', 'boolean'],
            'weight' => ['nullable', 'integer', 'between:0,255'],
        ];
    }
}
