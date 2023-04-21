@extends('layouts.login')

@section('content')
<!-- 投稿フォーム -->
 <div class="container">
  <!-- ユーザーアイコン入れる -->
  <img src="images/arrow.png">
  <!-- フォーム開始タグと同義　urlがtopになっているページにフォーム -->
        {!! Form::open(['url' => 'post/create']) !!}
        <div class="form-group">
            {!! Form::input('text', 'newPost', null, ['required', 'class' => 'form-control', 'placeholder' => '投稿内容を入力してください。']) !!}
        </div>
        <button type="submit" class="btn btn-success pull-right"><img src="/images/post.png"></button>
        {!! Form::close() !!}
</div>
@endsection
