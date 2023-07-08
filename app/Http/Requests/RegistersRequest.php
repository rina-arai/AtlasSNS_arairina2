<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegistersRequest extends FormRequest
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
            'username' => 'required|string|between:2,12',
            'mail' => 'required|string|email|between:5,40|unique:users',
            // password_confirmedという項目(confirmed)
            'password' => 'required|alpha_num|between:8,20|confirmed',
            'password_confirmation' => 'required|alpha_num|between:8,20',
        ];
    }

    public function messages()
    {
        return [
            'username.required' => '名前を入力してください',
            'username.between' => '2～12で入力してください',
            'mail.required' => 'メールを入力してください',
            'mail.email' => 'メール形式で入力してください',
            'mail.between' => '5～40で入力してください',
            'mail.unique' => 'このアドレスは使えません',
            'password.required' => 'パスワードを入力してください',
            'password.alpha_num' => '英数字のみで入力してください',
            'password.between' => '8～20で入力してください',
            'password.unique' => 'このパスワードは使えません',
            'password.confirmed' => 'パスワードが一致しません',
            'password_confirmation.required' => 'パスワードを入力してください',
            'password_confirmation.alpha_num' => '英数字のみで入力してください',
            'password_confirmation.between' => '8～20で入力してください',
        ];
    }

}
