<?php

namespace App\Http\Requests\ProjectMembers;

use App\Models\ProjectMembers;
use Illuminate\Foundation\Http\FormRequest;

class UpdateTypeMemberRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return auth()->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'member_type' => ['required', 'in:' . implode(',', array_keys(ProjectMembers::TYPES))]
        ];
    }
}
