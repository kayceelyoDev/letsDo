<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;

class boxRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        // STRICT: Only allow logged-in users to make this request
        return Auth::check();
    }

    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            'box_name' => [
                'required',
                'string',
                'min:3',        // Prevent names like "A"
                'max:50',       // Strict limit matching your UI design
                'regex:/^[\w\s-]+$/', // Optional: Only allow letters, numbers, spaces, dashes (No emojis/symbols)
            ],

            'box_description' => [
                'required',
                'string',
                'max:255',      // Prevent database truncation errors
            ],

            'privacy' => [
                'required',
                'string',
                Rule::in(['Public', 'Private']), // STRICT: Only allows these exact two words
            ],
            
           
        ];
    }

    /**
     * Get custom attributes for validator errors.
     * This makes error messages look nice (e.g., "The box name field is required" instead of "box_name")
     */
    public function attributes(): array
    {
        return [
            'box_name' => 'Box Name',
            'box_description' => 'Description',
            'privacy' => 'Privacy Setting',
        ];
    }

    /**
     * Get custom messages for specific errors.
     */
    public function messages(): array
    {
        return [
            'privacy.in' => 'The privacy setting must be either Public or Private.',
            'box_name.regex' => 'The Box Name contains invalid characters.',
        ];
    }
}