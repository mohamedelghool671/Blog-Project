<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BlogRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string',
            'description' => 'required|string|min:30',
            'image' => 'image|mimes:png,jpg.jpeg',
            'category_id' => 'required|exists:categories,id'
        ];
    }
    public function attributes(): array
    {
        return [
            'category_id' => 'category'
        ];
    }
}
