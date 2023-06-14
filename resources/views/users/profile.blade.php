@extends('layouts.login')

@section('content')

@if ($user->id == $users->id)
<!-- 自分のプロフィール -->

<!-- フォーム -->
<div>
<img src="{{$users->images}}">
{{Form::open(['url' => '/users/profile/update', 'files' => true])}}


<!-- ユーザーネーム -->
{{ Form::label('user name') }}
<!-- エラー文の表示 -->
@if($errors->has('username'))
			@foreach($errors->get('username') as $message)
				{{ $message }}<br>
			@endforeach
		@endif
{{ Form::text('username',$users->username,['class' => 'input']) }}<br>

<!-- メール -->
{{ Form::label('mail address') }}
<!-- エラー文の表示 -->
@if($errors->has('mail'))
			@foreach($errors->get('mail') as $message)
				{{ $message }}<br>
			@endforeach
		@endif
{{ Form::text('mail',$users->mail,['class' => 'input']) }}<br>

<!-- パスワード -->
{{ Form::label('password') }}
<!-- エラー文の表示 -->
@if($errors->has('password'))
			@foreach($errors->get('password') as $message)
				{{ $message }}<br>
			@endforeach
		@endif
{{ Form::password('password',null,['class' => 'input']) }}<br>

<!-- パスワード確認 -->
{{ Form::label('password confirm') }}
{{ Form::password('password_confirmation',null,['class' => 'input']) }}<br>

<!-- 自己紹介 -->
{{ Form::label('bio') }}
<!-- エラー文の表示 -->
@if($errors->has('bio'))
			@foreach($errors->get('bio') as $message)
				{{ $message }}<br>
			@endforeach
		@endif
{{ Form::text('bio',$users->bio,['class' => 'input']) }}<br>

<!-- アイコン -->
{{ Form::label('icon image') }}
<!-- エラー文の表示 -->
@if($errors->has('IconImage'))
			@foreach($errors->get('IconImage') as $message)
				{{ $message }}<br>
			@endforeach
		@endif
{{ Form::file('IconImage',null,['class' => 'file']) }}<br>

{{ Form::submit('更新') }}
{{Form::close()}}
</div>

@else
<!-- 自分以外のユーザー -->
<div>
  <!-- ユーザーアイコン -->
  <img src="{{$users->images}}">
  <p>{{$users->username}}</p>
  <div>
    <p>{{$users->bio}}</p>
  </div>

  <!-- フォローしているかの判定 -->
    @if (auth()->user()->isFollowing($users->id))
    <!-- フォロー解除 -->
      <form action="{{ route('unfollow_p', ['followed_id' => $users->id]) }}" method="POST">
        {{ csrf_field() }}
        {{ method_field('DELETE') }}
        <button type="submit" class="btn btn-danger">フォロー解除</button>
      </form>
      @else
      <!-- フォローする -->
      <form action="{{ route('follow_p', ['followed_id' => $users->id]) }}" method="POST">
        {{ csrf_field() }}
        <button type="submit" class="btn btn-primary">フォローする</button>
      </form>
      @endif
</div>

<!-- 投稿一覧 -->
<div class="container-list">
        <table class='table table-hover'>
            @foreach ($posts as $post)
            <tr>
                <td>{{ $post->user->username }}</td>
                <td><img src="{{ $post->user->images }}" alt="ユーザーアイコン"></td>
                <td>{{ $post->post }}</td>
                <td>{{ $post->created_at }}</td>
            </tr>
            @endforeach
        </table>
    </div>

    @endif
@endsection
