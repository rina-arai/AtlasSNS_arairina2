@extends('layouts.login')

@section('content')

    @if ($user->id == $users->id)
        <!-- 自分のプロフィール -->

        <!-- 編集フォーム -->
        <section class="profile">
            <figure><img src="{{ asset('storage/' . $users->image) }}" class="icon" alt="ユーザーアイコン"></figure>
            {{ Form::open(['url' => '/users/profile/update', 'files' => true]) }}


            <!-- ユーザーネーム -->
            <div class="profile_form">
                {{ Form::label('name', 'user name', ['class' => 'label']) }}
                <div>
                    {{ Form::text('username', $users->username, ['class' => 'input form-control']) }}
                    <div class="validate_text">
                        <!-- エラー文の表示 -->
                        @if ($errors->has('username'))
                            @foreach ($errors->get('username') as $message)
                                {{ $message }}<br>
                            @endforeach
                        @endif
                    </div>
                </div>
            </div>

            <!-- メール -->
            <div class="profile_form">
                {{ Form::label('name', 'mail address', ['class' => 'label']) }}
                <div>
                    {{ Form::text('mail', $users->mail, ['class' => 'input form-control']) }}
                    <div class="validate_text">
                        <!-- エラー文の表示 -->
                        @if ($errors->has('mail'))
                            @foreach ($errors->get('mail') as $message)
                                {{ $message }}<br>
                            @endforeach
                        @endif
                    </div>
                </div>
            </div>

            <!-- パスワード -->
            <div class="profile_form">
                {{ Form::label('name', 'password', ['class' => 'label']) }}
                <div>
                    {{ Form::password('password', ['class' => 'input form-control']) }}
                    <div class="validate_text">
                        <!-- エラー文の表示 -->
                        @if ($errors->has('password'))
                            @foreach ($errors->get('password') as $message)
                                {{ $message }}<br>
                            @endforeach
                        @endif
                    </div>
                </div>
            </div>

            <!-- パスワード確認 -->
            <div class="profile_form">
                {{ Form::label('name', 'password confirm', ['class' => 'label']) }}
                <div>
                    {{ Form::password('password_confirmation', ['class' => 'input form-control']) }}
                </div>
            </div>

            <!-- 自己紹介 -->
            <div class="profile_form">
                {{ Form::label('name', 'bio', ['class' => 'label']) }}
                <div>
                    {{ Form::text('bio', $users->bio, ['class' => 'input form-control']) }}
                    <div class="validate_text">
                        <!-- エラー文の表示 -->
                        @if ($errors->has('bio'))
                            @foreach ($errors->get('bio') as $message)
                                {{ $message }}<br>
                            @endforeach
                        @endif
                    </div>
                </div>
            </div>

            <!-- プロフィール画像 -->
            <div class="profile_form">
                {{ Form::label('name', 'icon image', ['class' => 'label']) }}
                <div>
                    <label class="form-control profile_file">
                        {{ Form::file('image', ['class' => 'file']) }}<p class="file_name">ファイルを選択</p>
                    </label>
                    <div class="validate_text">
                        <!-- エラー文の表示 -->
                        @if ($errors->has('image'))
                            @foreach ($errors->get('image') as $message)
                                {{ $message }}<br>
                            @endforeach
                        @endif
                    </div>
                </div>
            </div>

            <!-- 更新ボタン -->
            <div class="profile_btn">
                {{ Form::submit('更新', ['class' => 'btn btn-danger']) }}
            </div>

            {{ Form::close() }}
        </section>
    @else
        <!-- 自分以外のユーザー -->

        <section class="container gx-0 mw-100 profile_other">

            <div id="containerHead">
                <!-- ユーザー情報 -->
                <div class="profile_left">
                    <figure><img src="{{ asset('storage/' . $users->image) }}" class="icon" alt="ユーザーアイコン"></figure>
                    <!-- nameとbio -->
                    <div class="profile_lists">
                        <!-- name -->
                        <div class="profile_list">
                            <p>name</p>
                            <p>{{ $users->username }}</p>
                        </div>
                        <!-- bio -->
                        <div class="profile_list">
                            <p>bio</p>
                            <p>{{ $users->bio }}</p>
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
            <ul class="list-group list-group-flush">
                @foreach ($posts as $post)
                    <li class="list-group-item">
                        <div class="table_post">
                            <figure>
                                <img src="{{ asset('storage/' . $post->user->image) }}" class="icon" alt="ユーザーアイコン">
                            </figure>
                            <div class="table_posts">
                                <p class="post_name">{{ $post->user->username }}</p>
                                <p class="post_text">{{ $post->post }}</p>
                            </div>
                            <p class="post_time">{{ $post->created_at->format('Y/m/d H:i') }}</p>
                        </div>
                    </li>
                @endforeach
            </ul>
        </section>

    @endif
@endsection
