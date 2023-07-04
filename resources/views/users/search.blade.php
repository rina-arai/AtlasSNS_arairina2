@extends('layouts.login')

@section('content')

  <!-- 検索窓 -->
  <section id = "containerSearch">
      <form action="{{ url('/users/search') }}" class="input" method="GET">
          <input type="keyword" name="users"  placeholder="ユーザー名">
          <button type="submit" class="btn"><img src="/images/search.png" alt="検索"></button>
      </form>


    <!-- 検索ワードの表示 -->
    @if (!empty($keyword))
        <p>検索ワード：{{ $keyword }}</p>
    @endif
  </section>


  <!-- //* 保存されているレコードを一覧表示 *// -->

  <section>
        <table class='table list-group-item table_search'>
            @foreach ($users as $users)
            <!-- 自分以外のユーザーの表示 -->
            @if (!($user->username == $users->username))
            <tr>
                <td class="col"><img src="{{ $users->images }}" class = "icon" alt="ユーザーアイコン"></td>
                <td class="col-7">{{ $users->username }}</td>
                <!-- フォロー、解除ボタン -->
                <td class="col">
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
  </section>

@endsection
