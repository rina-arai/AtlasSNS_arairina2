@extends('layouts.logout')

@section('content')
    {!! Form::open(['url' => '/register/create']) !!}

    <h2 class="h2">新規ユーザー登録</h2>



    <!-- 新規登録フォーム -->
    <div id="containerLogout">

        <!-- ユーザー名 -->
        <div class="logout_input">
            {{ Form::label('name','username') }}
            <!-- エラー文の表示 -->
            <div class="validate_text">
                @if ($errors->has('username'))
                    @foreach ($errors->get('username') as $message)
                        {{ $message }}<br>
                    @endforeach
                @endif
            </div>
            <!-- フォーム -->
            {{ Form::text('username', null, ['class' => 'input']) }}<br>
        </div>

        <!-- メールアドレス -->
        <div class="logout_input">
            {{ Form::label('name','mail address') }}
            <!-- エラー文の表示 -->
            <div class="validate_text">
                @if ($errors->has('mail'))
                    @foreach ($errors->get('mail') as $message)
                        {{ $message }}<br>
                    @endforeach
                @endif
            </div>
            <!-- フォーム -->
            {{ Form::text('mail', null, ['class' => 'input']) }}<br>
        </div>

        <!-- パスワード -->
        <div class="logout_input">
            {{ Form::label('name','password') }}
            <!-- エラー文の表示 -->
            <div class="validate_text">
                @if ($errors->has('password'))
                    @foreach ($errors->get('password') as $message)
                        {{ $message }}<br>
                    @endforeach
                @endif
            </div>
            <!-- フォーム -->
            {{ Form::password('password', ['class' => 'input form-control']) }}<br>
        </div>

        <!-- パスワード確認 -->
        <div class="logout_input">
            {{ Form::label('name','password confirm') }}
            <!-- エラー文の表示 -->
            <div class="validate_text">
                @if ($errors->has('password_confirmation'))
                    @foreach ($errors->get('password_confirmation') as $message)
                        {{ $message }}<br>
                    @endforeach
                @endif
            </div>
            <!-- フォーム -->
            {{ Form::password('password_confirmation', ['class' => 'input form-control']) }}<br>
        </div>

        <!-- 新規登録ボタン -->
        <div class="btn_submit">
            {{ Form::submit('REGISTER', ['class' => 'btn btn-danger']) }}
        </div>
    </div>



    <p class="logout_p"><a href="/login">ログイン画面へ戻る</a></p>

    {!! Form::close() !!}
@endsection
