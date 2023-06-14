<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use App\Http\Requests\PostRequest;
use Session;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/login';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */

    //  バリデーション
    // protected function validator(array $data)
    // {
    //     return Validator::make($data, [
    //         'username' => 'required|string|between:2,12',
    //         'mail' => 'required|string|email|between:5,40|unique:users',
    //         // password_confirmedという項目(confirmed)
    //         'password' => 'required|string|alpha_num|between:8,20|confirmed',
    //     ]);
    // }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    // 登録のメソッド
    protected function create(array $data)
    {
        $user = User::create([
            'username' => $data['username'],
            'mail' => $data['mail'],
            'password' => bcrypt($data['password']),
        ]);
        // セッションへ名前のデータを保存する
        // 第１引数にはセッションキー、第２引数にはその値を指定
        session()->put(['username' => $user->username]);
        return session()->get('username');
    }


    // public function registerForm(){
    //     return view("auth.register");
    // }

    // public function register(Request $request){
    //     if($request->isMethod('post')){
    //         $data = $request->input();

    //         $this->create($data);
    //         return redirect('added');
    //     }
    //     return view('auth.register');
    // }

    // バリデーション後、新規登録成功後のメソッド
public function postValidates(PostRequest $request) {
//     isMethod() 引数に指定した文字列とHTTP動詞が一致するかを判定する
// 一致すればtrueが、しなければfalseが返る
  if($request->isMethod('post')){
            $data = $request->input();

            $this->create($data);
            return redirect('added');
        }
        return view('auth.register');
}

    // 登録成功の画面
    public function added(){
        // セッションで保存したデータを取得
        $value = session('username');
        return view('auth.added');
    }
}
