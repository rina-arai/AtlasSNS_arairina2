@extends('layouts.logout')

@section('content')

{!! Form::open(['url' => '/register/create']) !!}

<h2 class="h2">新規ユーザー登録</h2>

<div class="logout-f">
<div class="logout-input">
{{ Form::label('ユーザー名') }}
<!-- エラー文の表示 -->
@if($errors->has('username'))
			@foreach($errors->get('username') as $message)
				{{ $message }}<br>
			@endforeach
		@endif
		<!-- フォーム -->
{{ Form::text('username',null,['class' => 'input']) }}<br>
</div>

<div class="logout-input">
{{ Form::label('メールアドレス') }}
<!-- エラー文の表示 -->
@if($errors->has('mail'))
			@foreach($errors->get('mail') as $message)
				{{ $message }}<br>
			@endforeach
		@endif
		<!-- フォーム -->
{{ Form::text('mail',null,['class' => 'input']) }}<br>
</div>

<div class="logout-input">
{{ Form::label('パスワード') }}
<!-- エラー文の表示 -->
@if($errors->has('password'))
			@foreach($errors->get('password') as $message)
				{{ $message }}<br>
			@endforeach
		@endif
		<!-- フォーム -->
{{ Form::password('password',['class' => 'input form-control']) }}<br>
</div>

<div class="logout-input">
{{ Form::label('パスワード確認') }}<br>
<!-- エラー文の表示 -->
@if($errors->has('password_confirmation'))
			@foreach($errors->get('password_confirmation') as $message)
				{{ $message }}<br>
			@endforeach
		@endif
		<!-- フォーム -->
{{ Form::password('password_confirmation',['class' => 'input form-control']) }}<br>
</div>
<div class = " submit-d">
{{ Form::submit('REGISTER',['class' => 'btn btn-danger']) }}
</div>
</div>

<p class="new"><a href="/login">ログイン画面へ戻る</a></p>

{!! Form::close() !!}


@endsection
