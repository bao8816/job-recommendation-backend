<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateApplicationRequest extends FormRequest
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
            'job_id' => [
                'required',
                // regex: not allow special characters
                'regex:/^[a-zA-Z0-9\s]+$/',
            ],
            'cv_path' => [
                'required',
                'string',
            ],
            'time_tale' => [
                'required',
                'boolean',
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
            'job_id.required' => 'Yêu cầu nhập job_id',
            'job_id.regex' => 'job_id không được chứa ký tự đặc biệt',

            'cv_path.required' => 'Yêu cầu nhập đường dẫn CV',
            'cv_path.string' => 'Đường dẫn CV phải là chuỗi',

            'time_tale.required' => 'Yêu cầu nhập thời gian biểu',
            'time_tale.boolean' => 'Thời gian biểu phải là boolean',
        ];
    }
}
