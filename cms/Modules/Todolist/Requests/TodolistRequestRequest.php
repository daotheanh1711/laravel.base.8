<?php

namespace Cms\Modules\Todolist\Requests;


use Illuminate\Foundation\Http\FormRequest;

class TodolistRequestRequest extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        return [
            'title' => 'required|max:30 ',
            'content' => 'required',
            'user_id' => 'required',
        ];
    }

    /**
     * Get custom messages for validator errors.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'title.required' => 'Bạn chưa nhập tiêu đề',
            'title.max' => 'Tiêu đề tối đa :max ký tự',
            'content.required' => 'Bạn chưa nhập nội dung',
            'user_id.required' => 'Bạn chưa phân công việc',
        ];
    }
}

