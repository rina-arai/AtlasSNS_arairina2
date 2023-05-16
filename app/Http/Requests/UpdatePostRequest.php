<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePostRequest extends FormRequest
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
            'post' => 'required|string|between:1,150',
        ];
    }

    public function messages()
    {
  return [
    'post.required' => '必須項目です',
    'post.between' => '1文字以上,150文字以内で入力してください',
  ];
}
}
