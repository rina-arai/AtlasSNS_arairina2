@extends('layouts.login')

@section('content')
<!-- 投稿フォーム -->
 <div class="container">
  <!-- ユーザーアイコン入れる -->
  <img src="{{$user->images}}">
  <!-- エラー文の表示 -->
  <!-- 上にまとめてエラー文の表示 -->
@if($errors->has('newPost'))
			@foreach($errors->get('newPost') as $message)
				{{ $message }}<br>
			@endforeach
		@endif
  <!-- フォーム開始タグと同義　urlが/createの見えないページで登録処理 -->
        {!! Form::open(['url' => 'posts/create']) !!}
        <div class="form-group">
        <!-- フォームエリア 'required'を入れるとエラーメッセージ消える-->
            {!! Form::input('text', 'newPost', null, ['class' => 'form-control', 'placeholder' => '投稿内容を入力してください。']) !!}
        </div>
        <!-- 投稿ボタン -->
        <button type="submit" class="btn btn-success pull-right"><img src="/images/post.png"></button>
        {!! Form::close() !!}
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
                <!-- 編集ボタン -->
                <td>
                    @if ($user->id == $post->user_id)
                    <div class="content">
                    <!-- 投稿の編集ボタン -->
                    <a class="js-modal-open" href="/posts/index" post="{{ $post->post }}" post_id="{{ $post->id }}" ><img src="/images/edit.png"></a>
                </div>
                @endif
    <!-- モーダルの中身 -->
    <div class="modal js-modal">
        <div class="modal__bg js-modal-close"></div>
        <div class="modal__content">
           <form action="/posts/update" method="post">
            @method('PUT')
      {{ csrf_field() }}
            <!-- エラーメッセージ -->
            @if($errors->has('post'))
			@foreach($errors->get('post') as $message)
				{{ $message }}<br>
			@endforeach
		@endif
                <textarea name="post" class="modal_post"></textarea>
                <input type="hidden" name="id" class="modal_id" value="投稿id">
                <input type="submit" value="更新">
                {{ csrf_field() }}
           </form>
           <a class="js-modal-close" href="">閉じる</a>
        </div>
    </div>
</td>
<!-- 削除ボタン -->
<td>
    @if ($user->id == $post->user_id)
                <div class="content btn-trash">
                    <!-- 投稿の削除ボタン -->
                        <a href="/posts/{{ $post->id }}/delete" onClick="return confirm('本当に削除しますか？');return false;">
                    <img src="/images/trash.png"><img src="/images/trash-h.png"></a>
                        {{ csrf_field() }}
                </div>
                @endif
</td>
            </tr>
            @endforeach
        </table>
    </div>
@endsection
