@extends('layouts.login')

@section('content')

@if ($user->id == $users->id)
<!-- 自分のプロフィール -->

<!-- フォーム -->
<div>
<img src="{{$users->images}}">
{{ Form::label('user name') }}
{{ Form::text('username',null,['class' => 'input']) }}<br>


{{ Form::label('mail address') }}
{{ Form::text('mail',null,['class' => 'input']) }}<br>


{{ Form::label('password') }}
{{ Form::password('password',null,['class' => 'input']) }}<br>


{{ Form::label('password confirm') }}
{{ Form::password('password_confirmation',null,['class' => 'input']) }}<br>

{{ Form::label('bio') }}
{{ Form::text('bio',null,['class' => 'input']) }}<br>

{{ Form::label('icon image') }}
{{ Form::image('icon',null,['class' => 'input']) }}<br>

{{ Form::submit('更新') }}
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
