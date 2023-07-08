@extends('layouts.logout')

@section('content')
    <!-- ログイン完了後レイアウト -->
    <div id="clear">
        <div>
            @if (session('username'))
                <p class="h2">{{ Session('username') }}さん</p>
            @endif
            <p class="h3">ようこそ！AtlasSNSへ！</p>
        </div>

        <div class="clear_p">
            <p>ユーザー登録が完了しました。</p>
            <p>早速ログインをしてみましょう。</p>
        </div>
        <div class="submit_p"><a href="/login" class="btn btn-danger">ログイン画面へ</a></div>
    </div>
@endsection
