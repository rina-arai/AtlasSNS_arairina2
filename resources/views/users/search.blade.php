@extends('layouts.login')

@section('content')
<!-- 検索窓 -->
<div>
  <form action="{{ route('users.search') }}" method="GET">
    <input type="text" name="keyword" value="{{ $keyword }}" placeholder="ユーザー名">
    <button type="submit" class="btn btn-success pull-right"><img src="/images/search.png"></button>
  </form>
</div>

<table>
//* 保存されているレコードを一覧表示　*//
  @forelse ($users as $user)
    <tr>
      <td>{{ $user->image }}</td>
      <td><a href="{{ route('users.search' , $user) }}">{{ $user->username }}</td></a>
    </tr>
  @empty
    <td>No users!!</td>
  @endforelse
</table>

@endsection
