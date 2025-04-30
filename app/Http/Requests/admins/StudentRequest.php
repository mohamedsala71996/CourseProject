<?php

namespace App\Http\Requests\admins;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StudentRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $studentId = $this->route('student')?->id;

        return [
            'name' => ['required', 'string', 'max:255'],
            'id_number' => ['required', 'string', Rule::unique('students', 'id_number')->ignore($studentId)],
            'email' => ['required', 'email', Rule::unique('students', 'email')->ignore($studentId)],
            'phone' => ['required', 'string', Rule::unique('students', 'phone')->ignore($studentId)],
            'sub_stage_id' => ['required', 'exists:sub_stages,id'],
            'gender' => ['nullable', Rule::in(['male', 'female'])],
            'date_of_birth' => ['nullable', 'date'],
            'image' => ['nullable', 'image', 'max:2048'],
            'is_blocked' => ['nullable', 'boolean'],
            'password' => ['required', 'string', 'min:6'],
        ];
    }
}
