<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class NewPostRequest extends FormRequest
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
            'newPost' => 'required|string|between:1,150',
        ];
    }

    public function messages()
    {
        return [
            'newPost.required' => '必須項目です',
            'newPost.between' => '1文字以上,150文字以内で入力してください',
        ];
    }
}
