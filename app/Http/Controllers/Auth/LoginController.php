<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Auth;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
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
        // guestルートがlogoutの場合を除いて、常にミドルウェアを使用
        $this->middleware('guest')->except('logout');
    }

    // ログインメソッド
    public function login(Request $request){
        if($request->isMethod('post')){

            $data=$request->only('mail','password');
            // ログインが成功したら、トップページへ
            //↓ログイン条件は公開時には消すこと
            if(Auth::attempt($data)){
                return redirect('/posts/index');
            }
        }
        return view("auth.login");
    }

    // ログアウトメソッド　loggedOut 関数
    protected function loggedOut(Request $request) {
        return redirect('login');
    }

}
