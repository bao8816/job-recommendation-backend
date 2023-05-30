<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SignInRequest extends FormRequest
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
        return [
            'username' => [
                'required',
                'string',
                'exists:company_accounts,username',
                'exists:user_accounts,username',
            ],
            'password' => [
                'required',
                'string',
            ],
        ];
    }

    /**
     * Get the validation messages that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function messages()
    {
        return [
            'username.required' => 'Yêu cầu nhập tên đăng nhập',
            'username.string' => 'Tên đăng nhập phải là dạng chuỗi',
            'username.exists' => 'Tên đăng nhập không tồn tại',
            'password.required' => 'Yêu cầu nhập mật khẩu',
            'password.string' => 'Mật khẩu phải là dạng chuỗi',
        ];
    }
}
