<?php

namespace App\Http\Requests\admins;

use Illuminate\Foundation\Http\FormRequest;

class SubjectRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true; // Set this to false if needed
    }

    /**
     * Get the validation rules for the request.
     */
    public function rules(): array
    {
        return [
            'name'         => 'required|string|max:255',
            'desc'         => 'nullable|string',
            'sub_stage_id' => 'required|exists:sub_stages,id',
        ];
    }
}
