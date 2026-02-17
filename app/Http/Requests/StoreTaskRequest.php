<?php

namespace App\Http\Requests;

use App\Rules\QuarterHour as QuarterHourRule;
use Illuminate\Foundation\Http\FormRequest;

class StoreTaskRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'requirement_id' => ['required', 'integer'],
            'name' => ['required', 'string', 'max:255'],
            'estimate' => ['nullable', 'numeric', new QuarterHourRule()],
            'is_complete' => ['required', 'boolean'],
            'weight' => ['nullable', 'integer', 'between:0,255'],
        ];
    }
}
