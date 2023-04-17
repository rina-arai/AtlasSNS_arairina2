@extends('layouts.login')

@section('content')
<!-- 投稿フォーム -->
 <div class="container">
  <img src="images/arrow.png">

  <div class="container">
    <!-- ユーザーアイコン入れる -->
  <!-- フォーム開始タグと同義　urlがtopになっているページにフォーム -->
        {!! Form::open(['url' => 'posts/create']) !!}
        <div class="form-group">
            {!! Form::input('text', 'newPost', null, ['required', 'class' => 'form-control', 'placeholder' => '投稿内容を入力してください。']) !!}
        </div>
        <button type="submit" class="btn btn-success pull-right"><img src="/images/post.png"></button>
        {!! Form::close() !!}
    </div>
</div>
@endsection
