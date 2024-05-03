<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreatePractRequest extends FormRequest
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
            'pract_name' => 'required',
            'type' => 'required',
            'view' => 'required',
            'agreement' => 'required',
            'year' => 'required',
            'begin' => 'required',
            'end' => 'required',
            'date' => 'required',
            'order' => 'required',
        ];
    }
}
