<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SignUpRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        //TODO: Add validation for username and password
        return [
            'username' => 'required|string|unique:user_accounts,username',
            'password' => 'required|string',
            'password_confirmation' => 'required|string|same:password',
        ];
    }
}
