@extends('layouts.login')

@section('content')

    <!-- 投稿フォーム -->
    <section class="container gx-0 mw-100 ">
        <div id="containerHead">
            <figure><img src="{{ asset('storage/' . $user->image) }}" class="icon" alt="ユーザーアイコン"></figure>
            <!-- 投稿エリアフォーム -->
            <!-- フォーム開始タグと同義　urlが/createの見えないページで登録処理 -->
            {!! Form::open(['url' => 'posts/create']) !!}
            <div class="new_post">
                <!-- フォームエリア 'required'を入れるとエラーメッセージ消える-->
                {!! Form::textarea('newPost', null, [
                    'class' => 'form-control form_layout text_start',
                    'placeholder' => '投稿内容を入力してください。',
                ]) !!}
                <div class="validate_text">
                    <!-- エラー文の表示 -->
                    @if ($errors->has('newPost'))
                        @foreach ($errors->get('newPost') as $message)
                            {{ $message }}<br>
                        @endforeach
                    @endif
                </div>
            </div>
            <!-- 投稿ボタン -->
            <button type="submit" class="btn-success pull-right form_btn"><img src="/images/post.png" alt="投稿"></button>
            {!! Form::close() !!}
        </div>
    </section>





    <!-- 投稿一覧 -->
    <section class="container_list">
        <ul class="list-group list-group-flush">

            @foreach ($posts as $post)
                <li class="list-group-item">

                    <!-- 投稿内容 -->
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


                    <!-- 編集、削除ボタン -->
                    <div class="table_btn">
                        <!-- 編集ボタン -->
                        <div>
                            @if ($user->id == $post->user_id)
                                <div class="">
                                    <!-- 投稿の編集ボタン -->
                                    <a class="js-modal-open" href="/posts/index" post="{{ $post->post }}" post_id="{{ $post->id }}">
                                        <img src="/images/edit.png" alt="投稿編集">
                                    </a>
                                </div>
                            @endif
                            <!-- モーダルの中身 -->
                            <div class="modal js-modal">
                                <div class="modal__bg js-modal-close"></div>
                                <div class="modal__content">
                                    <form action="/posts/update" method="post">
                                        @method('PUT')
                                        {{ csrf_field() }}
                                        <textarea name="post" class="modal_post"></textarea>
                                        <div class="validate_text">
                                        <!-- エラーメッセージ -->
                                        @if ($errors->has('post'))
                                            @foreach ($errors->get('post') as $message)
                                                {{ $message }}<br>
                                            @endforeach
                                        @endif
                                        </div>
                                        <input type="hidden" name="id" class="modal_id" value="投稿id">
                                        <input type="image" src="/images/edit.png" class="edit">
                                        {{ csrf_field() }}
                                    </form>
                                </div>
                            </div>
                        </div>
                        <!-- 削除ボタン -->
                        <div>
                            @if ($user->id == $post->user_id)
                                <div class="btn_trash">
                                    <!-- 投稿の削除ボタン -->
                                    <a href="/posts/{{ $post->id }}/delete"
                                        onclick="showConfirmationModal('この投稿を削除します。よろしいでしょうか?', '/posts/{{ $post->id }}/delete'); return false;">
                                        <img src="/images/trash.png" alt="削除"><img src="/images/trash-h.png" alt="削除">
                                    </a>
                                    {{ csrf_field() }}
                                    <div id="customAlert" class="alert-container">
                                        <div class="alert-content">
                                            <p id="alertMessage"></p>
                                            <div class="alert_buttons">
                                                <button id="confirmButton" class="btn btn-primary btn_alert">OK</button>
                                                <button id="cancelButton" class="btn btn_alert">キャンセル</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                </li>
            @endforeach
        </ul>
    </section>
@endsection
