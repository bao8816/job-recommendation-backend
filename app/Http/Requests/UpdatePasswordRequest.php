<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePasswordRequest extends FormRequest
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
            'old_password' => [
                'required',
                'string',
                'min:8',
            ],
            'new_password' => [
                'required',
                'string',
                'min:8',
                'max:20',
                // regex: at least 1 letter and 1 number and no special characters
                'regex:/^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{8,20}$/',
            ],
            'confirm_password' => [
                'required',
                'string',
                'same:new_password',
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
            'old_password.required' => 'Mật khẩu cũ không được để trống',
            'old_password.string' => 'Mật khẩu cũ phải là chuỗi',
            'old_password.min' => 'Mật khẩu cũ phải có ít nhất 8 ký tự',

            'new_password.required' => 'Mật khẩu mới không được để trống',
            'new_password.string' => 'Mật khẩu mới phải là chuỗi',
            'new_password.min' => 'Mật khẩu mới phải có ít nhất 8 ký tự',
            'new_password.max' => 'Mật khẩu mới phải có nhiều nhất 20 ký tự',
            'new_password.regex' => 'Mật khẩu mới phải có ít nhất 1 chữ cái và 1 số',

            'confirm_password.required' => 'Nhập lại mật khẩu không được để trống',
            'confirm_password.string' => 'Nhập lại mật khẩu phải là chuỗi',
            'confirm_password.same' => 'Nhập lại mật khẩu không khớp',
        ];
    }
}
