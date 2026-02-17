<?php

namespace Spectacular\Core\Http\Requests;

use Spectacular\Core\Rules\QuarterHour as QuarterHourRule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateRequirementRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'blocked_reason' => ['sometimes', 'nullable', 'string', 'max:255'],
            'description' => ['sometimes', 'nullable', 'string'],
            'feature_id' => ['sometimes', 'bail', 'required', 'integer'],
            'name' => ['sometimes', 'required', 'string', 'max:255'],
            'unknowns' => ['sometimes', 'array'],
            'unknowns.*.id' => ['sometimes', 'bail', 'required', 'integer'],
            'unknowns.*.name' => ['required', 'string', 'max:255'],
            'user_ids' => ['sometimes', 'array'],
            'user_ids.*' => ['integer'],
            'tasks' => ['sometimes', 'array'],
            'tasks.*.id' => ['sometimes', 'bail', 'required', 'integer'],
            'tasks.*.estimate' => ['nullable', 'numeric', new QuarterHourRule()],
            'tasks.*.is_complete' => ['nullable', 'boolean'],
            'tasks.*.name' => ['required', 'string', 'max:255'],
            'tasks.*.weight' => ['nullable', 'integer', 'min:0', 'max:255'],
            'source' => ['sometimes', 'nullable', 'string', 'max:255'],
            'weight' => ['nullable', 'integer', 'between:0,255'],
        ];
    }
}
