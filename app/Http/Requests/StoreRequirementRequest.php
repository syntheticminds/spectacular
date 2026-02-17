<?php

namespace App\Http\Requests;

use App\Rules\QuarterHour as QuarterHourRule;
use Illuminate\Foundation\Http\FormRequest;

class StoreRequirementRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'blocked_reason' => ['nullable', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'feature_id' => ['required', 'integer'],
            'name' => ['required', 'string', 'max:255'],
            'unknowns' => ['nullable', 'array'],
            'unknowns.*.name' => ['required', 'string', 'max:255'],
            'user_ids' => ['array'],
            'user_ids.*' => ['integer'],
            'source' => ['nullable', 'string', 'max:255'],
            'tasks' => ['nullable', 'array'],
            'tasks.*.estimate' => ['nullable', 'numeric', new QuarterHourRule()],
            'tasks.*.is_complete' => ['nullable', 'boolean'],
            'tasks.*.name' => ['required', 'string', 'max:255'],
            'tasks.*.weight' => ['nullable', 'integer', 'min:0', 'max:255'],
            'weight' => ['nullable', 'integer', 'between:0,255'],
        ];
    }
}
