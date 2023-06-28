@extends('layouts.logout')

@section('content')

<div id="clear">
  <div>
  @if (session('username'))
  <p class="h2">{{ Session('username') }}さん</p>
  @endif
  <p class="h3">ようこそ！AtlasSNSへ！</p>
  </div>

  <div class="clear-p">
  <p>ユーザー登録が完了しました。</p>
  <p>早速ログインをしてみましょう。</p>
  </div>
  <div class="submit-p"><a href="/login" class="btn btn-danger">ログイン画面へ</a></div>
</div>
@endsection
