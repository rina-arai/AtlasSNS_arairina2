<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8" />
    <!--IEブラウザ対策-->
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="description" content="ページの内容を表す文章" />
    <title></title>
    <!-- bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('css/reset.css') }} ">
    <link rel="stylesheet" href="{{ asset('css/style.css') }} ">
    <!--スマホ,タブレット対応-->
    <meta name="viewport" content="width=device-width,initial-scale=1" />
    <!--サイトのアイコン指定-->
    <link rel="icon" href="画像URL" sizes="16x16" type="image/png" />
    <link rel="icon" href="画像URL" sizes="32x32" type="image/png" />
    <link rel="icon" href="画像URL" sizes="48x48" type="image/png" />
    <link rel="icon" href="画像URL" sizes="62x62" type="image/png" />
    <!--iphoneのアプリアイコン指定-->
    <link rel="apple-touch-icon-precomposed" href="画像のURL" />
    <!--OGPタグ/twitterカード-->

  </head>

</head>
<body>
    <header>
        <div id = "head">
            <h1><a href="http://127.0.0.1:8000/posts/index"><img src="/images/atlas.png"></a></h1>
            <div id="menu">
                <details>
                 <summary>
                  <div id="menu-icon">
                    <p>{{ Auth::user()->username }} さん</p><span class="up-icon"></span>
                  </div>
                 </summary>
                 <ul class="dropdown-lists">
                    <li><a href="/posts/index">HOME</a></li>
                    <li><a href="/users/{{ $user->id }}/profile">プロフィール編集</a></li>
                    <li><a href="/logout">ログアウト</a></li>
                 </ul>
                </details>
                <img src="{{$user->images}}" class="icon">
            </div>
        </div>
    </header>
    <div id="row">
        <div id="container">
            @yield('content')
        </div >
        <div id="side-bar">
            <div id="confirm">
                <p>{{ Auth::user()->username }}さんの</p>
                <div class="side-n">
                <p>フォロー数</p>
                <p>{{ $following_count->count() }}名</p>
                </div>
                <div class="side-btn"><button type="button" class="btn btn-primary"><a href="/follow-list">フォローリスト</a></button></div>
                <div class="side-n">
                <p>フォロワー数</p>
                <p>{{ $followed_count->count() }}名</p>
                </div>
                <div class="side-btn"><button type="button" class="btn btn-primary"><a href="/follower-list">フォロワーリスト</a></button></div>
            </div>

            <div class="side-btn-s"><button type="button" class="btn btn-primary"><a href="/users/search">ユーザー検索</a></button></div>
        </div>
    </div>
    <footer>
    </footer>
    <!-- jQuery読み込み -->
    <script src="{{ asset('js/jquery-3.6.3.min.js') }}"></script>
    <script src="{{ asset('js/script.js') }}"></script>
    <!-- <script src="JavaScriptファイルのURL"></script> -->
</body>
</html>
