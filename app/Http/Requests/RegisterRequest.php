<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\DTO\registerDTO;

class RegisterRequest extends FormRequest
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
            'first_name' => 'required|string|max:50',
            'second_name' => 'required|string|max:50',
            'third_name' => 'string|max:50',
            'login' => 'required|string|unique:users',
            'password' => 'required|string|min:8',
            'c_password' => 'required|string|min:8|same:password',
        ];
    }

    public function createDTO() : RegisterDTO {
        return new registerDTO(
            $this->input('first_name'),
            $this->input('second_name'),
            $this->input('third_name'),
            $this->input('password'),
            $this->input('login'),
        );
    }
}
