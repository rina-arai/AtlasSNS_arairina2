@extends('layouts.logout')

@section('content')
    {!! Form::open(['url' => '/login']) !!}

    <h2 class="h2">AtlasSNSへようこそ</h2>

    <!-- ログインフォーム -->
    <div id="containerLogout">
        <!-- メールアドレス -->
        <div class="logout_input">
            {{ Form::label('name','mail address') }}
            {{ Form::text('mail', null, ['class' => 'input']) }}
        </div>
        <!-- パスワード -->
        <div class="logout_input">
            {{ Form::label('name','password') }}
            {{ Form::password('password', ['class' => 'input']) }}
        </div>
        <!-- パスワード確認 -->
        <div class="btn_submit">
            {{ Form::submit('LOGIN', ['class' => 'btn btn-danger']) }}
            @csrf
        </div>
    </div>
    <p class="logout_p"><a href="/register">新規ユーザーの方はこちら</a></p>

    {!! Form::close() !!}
@endsection
