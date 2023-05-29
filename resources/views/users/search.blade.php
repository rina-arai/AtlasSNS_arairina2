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
                <!-- フォロー、解除ボタン -->
                <td>
                  <!-- フォローしているかの判定 -->
                                    @if (auth()->user()->isFollowing($users->id))
                                    <!-- フォロー解除 -->
                                    <form action="{{ route('unfollow', ['followed_id' => $users->id]) }}" method="POST">
                                        {{ csrf_field() }}
                                        {{ method_field('DELETE') }}
                                        <button type="submit" class="btn btn-danger">フォロー解除</button>
                                    </form>
                                @else
                                <!-- フォローする -->
                                <form action="{{ route('follow', ['followed_id' => $users->id]) }}" method="POST">
                                        {{ csrf_field() }}
                                        <button type="submit" class="btn btn-primary">フォローする</button>
                                    </form>
                                @endif

                </td>

            </tr>
            @endif
            @endforeach
        </table>

    </div>

@endsection
