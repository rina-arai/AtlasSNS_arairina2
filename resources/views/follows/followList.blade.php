@extends('layouts.login')

@section('content')
<div class="container-list">

<!-- アイコン一覧 -->
  <div class="container gx-0 mw-100 ">
    <div id = "container-head">
       <h3>Follow List</h3>
        <div class="list-group list-group-flush follower-head">
            @foreach ($users as $user)
                <p><a href="/users/{{ $user->id }}/profile"><img src="{{ $user->images }}" class="icon" alt="ユーザーアイコン"></a></p>
            @endforeach
        </div>
    </div>
  </div>

        <!-- 投稿一覧 -->
        <ul class='list-group list-group-flush'>
            @foreach ($posts as $post)
            <li class="list-group-item">
              <div class="table-post">
                   <p><a href="/users/{{ $post->user->id }}/profile"><img src="{{ $post->user->images }}" class="icon" alt="ユーザーアイコン"></a></p>
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
@endsection
