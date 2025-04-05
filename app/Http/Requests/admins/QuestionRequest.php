<?php

namespace App\Http\Requests\admins;

use Illuminate\Foundation\Http\FormRequest;

class QuestionRequest extends FormRequest
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
            'question_text' => 'required|string',
            'read_text' => 'nullable|string',
            'video' => 'nullable|file|mimes:mp4,avi,mov|max:10240', // Max 10MB
            'record' => 'nullable|file|mimes:mp3,wav|max:5120', // Max 5MB
            'options' => 'required|array|min:2',
            'options.*.text' => 'required|string',
            'correct_option' => 'required|integer|min:0',
        ];
    }
}
