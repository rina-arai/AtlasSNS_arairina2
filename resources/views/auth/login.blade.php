@extends('layouts.logout')

@section('content')

{!! Form::open(['url' => '/login']) !!}

<h2 class="h2">AtlasSNSへようこそ</h2>

<div class="logout-f">
  <div class="logout-input">
  {{ Form::label('e-mail') }}
  {{ Form::text('mail',null,['class' => 'input']) }}
  </div>
  <div class="logout-input">
  {{ Form::label('password') }}
  {{ Form::password('password',['class' => 'input']) }}
  </div>

  <div class = " submit-d">
  {{ Form::submit('LOGIN',['class' => 'btn btn-danger']) }}
  @csrf
  </div>

</div>
<p class="new"><a href="/register">新規ユーザーの方はこちら</a></p>

{!! Form::close() !!}

@endsection
