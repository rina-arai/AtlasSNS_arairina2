@extends('layouts.logout')

@section('content')

{!! Form::open(['url' => '/register/create']) !!}

<h2>新規ユーザー登録</h2>
<!-- @if ($errors->any())
    <div class="alert alert-danger mt-1">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif -->
{{ Form::label('ユーザー名') }}
@if($errors->has('username'))
			@foreach($errors->get('username') as $message)
				{{ $message }}<br>
			@endforeach
		@endif
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
@if($errors->has('password-confirm'))
			@foreach($errors->get('password-confirm') as $message)
				{{ $message }}<br>
			@endforeach
		@endif
{{ Form::text('password-confirm',null,['class' => 'input']) }}<br>


{{ Form::submit('登録') }}

<p><a href="/login">ログイン画面へ戻る</a></p>

{!! Form::close() !!}


@endsection
