@extends('layouts.logout')

@section('content')

{!! Form::open(['url' => '/register/create']) !!}

<h2>新規ユーザー登録</h2>
<!-- 上にまとめてエラー文の表示
@if ($errors->any())
    <div class="alert alert-danger mt-1">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif -->

{{ Form::label('ユーザー名') }}
<!-- エラー文の表示 -->
@if($errors->has('username'))
			@foreach($errors->get('username') as $message)
				{{ $message }}<br>
			@endforeach
		@endif
		<!-- ユーザーネームのフォーム -->
{{ Form::text('username',null,['class' => 'input']) }}<br>


{{ Form::label('メールアドレス') }}
@if($errors->has('mail'))
			@foreach($errors->get('mail') as $message)
				{{ $message }}<br>
			@endforeach
		@endif
{{ Form::text('mail',null,['class' => 'input']) }}<br>


{{ Form::label('パスワード') }}
@if($errors->has('password'))
			@foreach($errors->get('password') as $message)
				{{ $message }}<br>
			@endforeach
		@endif
{{ Form::text('password',null,['class' => 'input']) }}<br>


{{ Form::label('パスワード確認') }}
@if($errors->has('password_confirmation'))
			@foreach($errors->get('password_confirmation') as $message)
				{{ $message }}<br>
			@endforeach
		@endif
{{ Form::text('password_confirmation',null,['class' => 'input']) }}<br>


{{ Form::submit('登録') }}

<p><a href="/login">ログイン画面へ戻る</a></p>

{!! Form::close() !!}


@endsection
