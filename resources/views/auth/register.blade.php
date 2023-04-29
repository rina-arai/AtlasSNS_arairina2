@extends('layouts.logout')

@section('content')

{!! Form::open(['url' => '/register/create']) !!}

<h2>新規ユーザー登録</h2>

{{ Form::label('ユーザー名') }}
<!-- エラー文の表示 -->
@if($errors->has('username'))
			@foreach($errors->get('username') as $message)
				{{ $message }}<br>
			@endforeach
		@endif
		<!-- フォーム -->
{{ Form::text('username',null,['class' => 'input']) }}<br>


{{ Form::label('メールアドレス') }}
<!-- エラー文の表示 -->
@if($errors->has('mail'))
			@foreach($errors->get('mail') as $message)
				{{ $message }}<br>
			@endforeach
		@endif
		<!-- フォーム -->
{{ Form::text('mail',null,['class' => 'input']) }}<br>


{{ Form::label('パスワード') }}
<!-- エラー文の表示 -->
@if($errors->has('password'))
			@foreach($errors->get('password') as $message)
				{{ $message }}<br>
			@endforeach
		@endif
		<!-- フォーム -->
{{ Form::password('password',null,['class' => 'input']) }}<br>


{{ Form::label('パスワード確認') }}
<!-- エラー文の表示 -->
@if($errors->has('password_confirmation'))
			@foreach($errors->get('password_confirmation') as $message)
				{{ $message }}<br>
			@endforeach
		@endif
		<!-- フォーム -->
{{ Form::password('password_confirmation',null,['class' => 'input']) }}<br>


{{ Form::submit('登録') }}

<p><a href="/login">ログイン画面へ戻る</a></p>

{!! Form::close() !!}


@endsection
