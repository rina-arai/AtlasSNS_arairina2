@extends('layouts.login')

    @section('content')

    <!-- アイコン一覧 -->
    <section class="container gx-0 mw-100 ">
        <div id = "containerHead">
            <h3>Follow List</h3>
            <!-- アイコン -->
            <div class="list-group list-group-flush follower_head">
                @foreach ($users as $user)
                    <p><a href="/users/{{ $user->id }}/profile"><img src="{{ asset('storage/'.$user->image) }}" class="icon" alt="ユーザーアイコン"></a></p>
                @endforeach
            </div>
        </div>
    </section>

    <!-- 投稿一覧 -->
    <section>
        <ul class='list-group list-group-flush'>
            @foreach ($posts as $post)
                <li class="list-group-item">
                    <!-- 投稿内容 -->
                    <div class="table_post">
                        <p><a href="/users/{{ $post->user->id }}/profile"><img src="{{ asset('storage/'.$post->user->image) }}" class="icon" alt="ユーザーアイコン"></a></p>
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

@endsection
