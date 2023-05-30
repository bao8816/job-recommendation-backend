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
        return [
            'username' => [
                'required',
                'string',
                'unique:company_accounts,username',
                'unique:user_accounts,username',
            ],
            'password' => [
                'required',
                'string',
                'max:20',
                'min:8',
                'regex:/^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{8,20}$/',
            ],
            'confirm_password' => [
                'required',
                'string',
                'same:password',
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
            'username.unique' => 'Tên đăng nhập đã tồn tại',
            'password.required' => 'Yêu cầu nhập mật khẩu',
            'password.string' => 'Mật khẩu phải là dạng chuỗi',
            'password.max' => 'Mật khẩu không được quá 20 ký tự',
            'password.min' => 'Mật khẩu phải có ít nhất 8 ký tự',
            'password.regex' => 'Mật khẩu phải có ít nhất 1 chữ cái và 1 chữ số',
            'confirm_password.required' => 'Yêu cầu nhập lại mật khẩu xác nhận',
            'confirm_password.string' => 'Mật khẩu xác nhận phải là dạng chuỗi',
            'confirm_password.same' => 'Xác nhận mật khẩu không khớp',
        ];
    }
}
