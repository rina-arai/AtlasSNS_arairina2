@extends('layouts.login')

@section('content')
<!-- 検索窓 -->
<div>
  <form action="{{ url('/users/search') }}" method="GET">
    <input type="keyword" name="users"  placeholder="ユーザー名">
    <button type="submit" class="btn btn-success pull-right"><img src="/images/search.png"></button>
  </form>
</div>

<!-- 検索ワードの表示 -->
@if (!empty($keyword))
  <p>検索ワード：{{ $keyword }}</p>
@endif



<!-- //* 保存されているレコードを一覧表示 *// -->
<div class="container-list">

        <table class='table table-hover'>
            @foreach ($users as $users)
            <!-- 自分以外のユーザーの表示 -->
            @if (!($user->username == $users->username))
            <tr>
                <td>{{ $users->username }}</td>
                <td><img src="{{ $users->images }}" alt="ユーザーアイコン"></td>
            </tr>
            @endif
            @endforeach
        </table>

    </div>

@endsection
