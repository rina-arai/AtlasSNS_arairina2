<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\User;
use Illuminate\Support\Facades\Auth;

class ProRequest extends FormRequest
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
        $user = Auth::user();
        $rules = [
        'username' => 'required|string|between:2,12',
        'mail' => 'required|string|email|between:5,40|unique:users,mail,' . $user->id . ',id',
        'bio' => 'max:150',
        'image' => 'file|image|mimes:jpeg,png,bmp,gif,svg',
    ];

    // パスワードが入力されている場合にのみバリデーションルールを追加
    // inputメソッドは、リクエストに含まれる入力データを取得するために使用、フォームリクエストクラスはリクエストデータを扱うための特殊なクラス
    if ($this->input('password')) {
        // $rules配列に'password'というキーに対して、バリデーションを実装
        // $変数[''] = ;←連想配列における要素の追加や更新を 行うためのコード
        $rules['password'] = 'alpha_num|between:8,20|confirmed';
        $rules['password_confirmation'] = 'alpha_num|between:8,20';
    }


    return $rules;
    }

    public function messages()
    {
  return [
    'name.required' => '名前を入力してください',
    'name.between' => '2～12で入力してください',
    'mail.required' => 'メールを入力してください',
    'mail.between' => '5～40で入力してください',
    'mail.unique' => 'このアドレスは使えません',
    'password.alpha_num' => '英数字のみで入力してください',
    'password.between' => '8～20で入力してください',
    'password.confirmed' => 'このパスワードは違います',
    'image.mimes' => 'この拡張子は使用できません。',
    'bio.max' => '150字以内で入力してください',
  ];
}
}
