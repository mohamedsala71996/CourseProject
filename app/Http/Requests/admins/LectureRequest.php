<?php

namespace App\Http\Requests\admins;

use Illuminate\Foundation\Http\FormRequest;

class LectureRequest extends FormRequest
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
            'name' => 'required|string|max:255',
            'desc' => 'nullable|string',
            'subject_id' => 'required|exists:subjects,id',
        ];
    }
}
