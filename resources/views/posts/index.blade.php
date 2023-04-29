@extends('layouts.login')

@section('content')
<!-- 投稿フォーム -->
 <div class="container">
  <!-- ユーザーアイコン入れる -->
  <img src="{{Auth::user()->images}}">
  <!-- エラー文の表示 -->
  <!-- 上にまとめてエラー文の表示 -->
@if ($errors->any())
    <div class="alert alert-danger mt-1">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
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
            @foreach ($list as $list)
            <tr>
                <td>{{ $list->user_id }}</td>
                <td>{{ $list->post }}</td>
                <td>{{ $list->created_at }}</td>
            </tr>
            @endforeach
        </table>
    </div>
@endsection
