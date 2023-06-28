@extends('layouts.login')

@section('content')

 <div class="container gx-0 mw-100 ">
     <!-- 投稿フォーム -->
    <div id = "container-head">
      <img src="{{$user->images}}" class = "icon">
     <!-- フォーム開始タグと同義　urlが/createの見えないページで登録処理 -->
        {!! Form::open(['url' => 'posts/create']) !!}
        <div>
          <!-- フォームエリア 'required'を入れるとエラーメッセージ消える-->
            {!! Form::textarea( 'newPost', null, ['class' => 'form-control form-layout text-start', 'placeholder' => '投稿内容を入力してください。']) !!}
          <!-- エラー文の表示 -->
          <!-- 上にまとめてエラー文の表示 -->
          @if($errors->has('newPost'))
			    @foreach($errors->get('newPost') as $message)
				  {{ $message }}<br>
			    @endforeach
		      @endif
        </div>
        <!-- 投稿ボタン -->
        <button type="submit" class="btn-success pull-right form-btn"><img src="/images/post.png"></button>
        {!! Form::close() !!}
   </div>
</div>





<!-- 投稿一覧 -->
<div class="container-list">
<ul class="list-group list-group-flush">

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



            <div class="table-btn">
                <!-- 編集ボタン -->
                <div>
                    @if ($user->id == $post->user_id)
                    <div class="">
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
                                 <input type="image" src="/images/edit.png" class="edit">
                                  {{ csrf_field() }}
                             </form>
                               <!-- <a class="js-modal-close" href="">閉じる</a> -->
                            </div>
                        </div>
                </div>
                <!-- 削除ボタン -->
                <div>
                   @if ($user->id == $post->user_id)
                      <div class=" btn-trash">
                         <!-- 投稿の削除ボタン -->
                        <a href="/posts/{{ $post->id }}/delete" onClick="return confirm('この投稿を削除します。よろしいでしょうか？');return false;">
                         <img src="/images/trash.png"><img src="/images/trash-h.png"></a>
                        {{ csrf_field() }}
                       </div>
                    @endif
                </div>
            </div>
            </li>
            @endforeach

    </ul>
    </div>
@endsection
