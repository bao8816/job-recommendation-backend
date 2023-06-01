<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateUserExperienceRequest extends FormRequest
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
            'description' => [
                'required',
                'string',
                // regex: not allow special characters (@, #, $, &, *)
                'regex:/^[^@#$&*]+$/',
            ],
            'start' => [
                'required',
                'date',
            ],
            'end' => [
                'required',
                'date',
                'after:start',
            ],
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array<string, mixed>
     */
    public function messages()
    {
        return [
            'description.required' => 'Bắt buộc nhập kinh nghiệm',
            'description.string' => 'Kinh nghiệm phải là chuỗi ký tự',
            'description.regex' => 'Kinh nghiệm không được chứa ký tự đặc biệt (@, #, $, &, *)',
            'start.required' => 'Bắt buộc nhập ngày bắt đầu',
            'start.date' => 'Ngày bắt đầu phải là dạng ngày tháng',
            'end.required' => 'Bắt buộc nhập ngày kết thúc',
            'end.date' => 'Ngày kết thúc phải là dạng ngày tháng',
            'end.after' => 'Ngày kết thúc phải sau ngày bắt đầu',
        ];
    }
}
