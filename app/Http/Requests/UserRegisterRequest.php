<?php

namespace App\Http\Requests;

class UserRegisterRequest extends CustomFormRequest
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
            'username' => ['required', 'max:100', 'unique:users,username'],
            'password' => ['required', 'max:100'],
            'name' => ['required', 'max:100']
        ];
    }
}
