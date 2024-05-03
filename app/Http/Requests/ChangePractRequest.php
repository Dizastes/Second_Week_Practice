<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ChangePractRequest extends FormRequest
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
            'group' => 'required',
            'pract_name' => 'required',
            'type' => 'required',
            'view' => 'required',
            'agreement' => 'required',
            'year' => 'required',
            'begin' => 'required',
            'end' => 'required',
            'date' => 'required',
            'order' => 'required',
            'name' => 'required',
            'city' => 'required',
            'address' => 'required',
            'dir_university' => 'required',
            'dir_p' => 'required',
            'dir_o' => 'required',
            'dir_practise' => 'required',
        ];
    }
}
