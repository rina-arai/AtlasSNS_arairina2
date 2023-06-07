@extends('layouts.login')

@section('content')
<div class="container-list">
<p>Follow List</p>
        <table class='table table-hover'>
            @foreach ($users as $user)
            <tr>
                <td><a href="/users/{{ $user->id }}/profile"><img src="{{ $user->images }}" alt="ユーザーアイコン"></a></td>
            </tr>
            @endforeach
        </table>

        <table class='table table-hover'>
            @foreach ($posts as $post)
            <tr>
              <td>{{ $post->user->username }}</td>
                <td><a href="/users/{{ $post->user->id }}/profile"><img src="{{ $post->user->images }}" alt="ユーザーアイコン"></a></td>
                <td>{{ $post->post }}</td>
                <td>{{ $post->updated_at }}</td>
            </tr>
            @endforeach
        </table>

    </div>
@endsection
