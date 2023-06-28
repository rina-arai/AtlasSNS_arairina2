@extends('layouts.login')

@section('content')

@if ($user->id == $users->id)
<!-- 自分のプロフィール -->

<!-- フォーム -->
<div class="profile">
<img src="{{$users->images}}" class="icon">
{{Form::open(['url' => '/users/profile/update', 'files' => true])}}


<!-- ユーザーネーム -->
<div class="pro-form">
{{ Form::label('name','user name',['class' => 'label']) }}
  <!-- エラー文の表示 -->
@if($errors->has('username'))
			@foreach($errors->get('username') as $message)
				{{ $message }}<br>
			@endforeach
		@endif
{{ Form::text('username',$users->username,['class' => 'input form-control']) }}<br>
</div>

<!-- メール -->
<div class="pro-form">
{{ Form::label('name','mail address',['class' => 'label']) }}
  <!-- エラー文の表示 -->
@if($errors->has('mail'))
			@foreach($errors->get('mail') as $message)
				{{ $message }}<br>
			@endforeach
		@endif
{{ Form::text('mail',$users->mail,['class' => 'input form-control']) }}<br>
</div>

<!-- パスワード -->
<div class="pro-form">
{{ Form::label('name','password',['class' => 'label']) }}
  <!-- エラー文の表示 -->
@if($errors->has('password'))
			@foreach($errors->get('password') as $message)
				{{ $message }}<br>
			@endforeach
		@endif
{{ Form::password('password',['class' => 'input form-control']) }}<br>
</div>

<!-- パスワード確認 -->
<div class="pro-form">
{{ Form::label('name','password confirm',['class' => 'label']) }}
{{ Form::password('password_confirmation',['class' => 'input form-control']) }}<br>
</div>

<!-- 自己紹介 -->
<div class="pro-form">
{{ Form::label('name','bio',['class' => 'label']) }}
  <!-- エラー文の表示 -->
@if($errors->has('bio'))
			@foreach($errors->get('bio') as $message)
				{{ $message }}<br>
			@endforeach
		@endif
{{ Form::text('bio',$users->bio,['class' => 'input form-control']) }}<br>
</div>

<!-- アイコン -->
<div class="pro-form">
{{ Form::label('name','icon image',['class' => 'label']) }}
  <!-- エラー文の表示 -->
@if($errors->has('image'))
			@foreach($errors->get('image') as $message)
				{{ $message }}<br>
			@endforeach
		@endif
<label class="form-control pro-file">
{{ Form::file('image',['class' => 'file','id' => 'formFile']) }}<p>ファイルを選択</p>
</label><br>
</div>

<div class="pro-btn">
{{ Form::submit('更新',['class' => 'btn btn-danger']) }}
</div>

{{Form::close()}}
</div>

@else
<!-- 自分以外のユーザー -->
<div class="container gx-0 mw-100 profile-other">
  <!-- ユーザーアイコン -->
  <div id = "container-head">
  <div class="profile-left">
  <img src="{{$users->images}}" class="icon">
  <div class="profile-lists">
  <div class="profile-list">
    <p>name</p>
    <p>{{$users->username}}</p>
  </div>
  <div class="profile-list">
    <p>bio</p>
    <p>{{$users->bio}}</p>
  </div>
  </div>
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
</div>

<!-- 投稿一覧 -->
<div class="container-list">
        <ul  class="list-group list-group-flush">
            @foreach ($posts as $post)
            <li class="list-group-item">
              <div class="table-post">
                  <p><img src="{{ $post->user->images }}" class="icon" alt="ユーザーアイコン"></p>
                  <div class="table-posts">
                  <p class="post-name">{{ $post->user->username }}</p>
                  <p class="post-text">{{ $post->post }}</p>
                  </div>
                  <p class="post-time">{{ $post->created_at->format("Y/m/d H:i") }}</p>
              </div>
            </li>
            @endforeach
        </ul>
    </div>

    @endif
@endsection
