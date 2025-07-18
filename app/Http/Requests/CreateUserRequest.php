<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CreateUserRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => [
                'required',
                'string'
            ],
            'email' => [
                'required',
                'email',
                'unique:users'
            ],
            'password' => [
                'required',
                'string',
                'min:8',
                'confirmed'
            ],
            'zip_code' => [
                'required',
                'string',
                Rule::numeric(),
            ]
        ];
    }
}
