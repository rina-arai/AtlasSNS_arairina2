@extends('layouts.login')

@section('content')

@if ($user->id == $users->id)
<!-- 自分のプロフィール -->

<!-- フォーム -->
<section class="profile">
    <p><img src="{{$users->images}}" class="icon" alt="ユーザーアイコン"></p>
    {{Form::open(['url' => '/users/profile/update', 'files' => true])}}


    <!-- ユーザーネーム -->
    <div class="pro_form">
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
    <div class="pro_form">
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
<div class="pro_form">
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
<div class="pro_form">
{{ Form::label('name','password confirm',['class' => 'label']) }}
{{ Form::password('password_confirmation',['class' => 'input form-control']) }}<br>
</div>

<!-- 自己紹介 -->
<div class="pro_form">
{{ Form::label('name','bio',['class' => 'label']) }}
  <!-- エラー文の表示 -->
@if($errors->has('bio'))
			@foreach($errors->get('bio') as $message)
				{{ $message }}<br>
			@endforeach
		@endif
{{ Form::text('bio',$users->bio,['class' => 'input form-control']) }}<br>
</div>

<!-- プロフィール画像 -->
<div class="pro_form">
{{ Form::label('name','icon image',['class' => 'label']) }}
  <!-- エラー文の表示 -->
@if($errors->has('image'))
			@foreach($errors->get('image') as $message)
				{{ $message }}<br>
			@endforeach
		@endif
<label class="form-control pro_file">
{{ Form::file('image',['class' => 'file']) }}<p class="file_name">ファイルを選択</p>
</label><br>
</div>

<div class="pro_btn">
{{ Form::submit('更新',['class' => 'btn btn-danger']) }}
</div>

{{Form::close()}}
</section>

@else
<!-- 自分以外のユーザー -->
<section class="container gx-0 mw-100 profile_other">
  <!-- ユーザーアイコン -->
  <div id = "containerHead">
  <div class="profile_left">
  <img src="{{$users->images}}" class="icon" alt="ユーザーアイコン">
  <div class="profile_lists">
  <div class="profile_list">
    <p>name</p>
    <p>{{$users->username}}</p>
  </div>
  <div class="profile_list">
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
</section>

<!-- 投稿一覧 -->
<section class="container_list">
        <ul  class="list-group list-group-flush">
            @foreach ($posts as $post)
            <li class="list-group-item">
              <div class="table_post">
                  <p><img src="{{ $post->user->images }}" class="icon" alt="ユーザーアイコン"></p>
                  <div class="table_posts">
                  <p class="post_name">{{ $post->user->username }}</p>
                  <p class="post_text">{{ $post->post }}</p>
                  </div>
                  <p class="post_time">{{ $post->created_at->format("Y/m/d H:i") }}</p>
              </div>
            </li>
            @endforeach
        </ul>
</section>

    @endif
@endsection
