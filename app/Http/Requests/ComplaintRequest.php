<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class ComplaintRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
     public function authorize(): bool
    {
        return Auth::check() && Auth::user()->hasRole('user');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'office_id' => ['required', 'exists:office,id'],
            'subject' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string'],
            'category_id' => ['required', 'exists:categories,id'],
            'anonymous' => ['boolean'],
            'attachments.*' => ['nullable', 'file', 'mimes:jpg,png,pdf', 'max:2048'],
        ];
    }

    public function messages(): array
    {
        return [
            'subject.required' => 'Please provide a subject for your complaint.',
            'description.required' => 'Please describe your complaint.',
            'category_id.required' => 'Please select a complaint category.',
            'attachments.*.file' => 'Each attachment must be a valid file.',
            'attachments.*.max' => 'Each attachment must not exceed 2MB.',
        ];
    }
}
