<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <!--IEブラウザ対策-->
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="description" content="ページの内容を表す文章" />
    <title>AtlasSNS</title>
    <!-- bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <!-- css -->
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


<body>
    <!-- header -->
    <header>
        <div id="head">
            <!-- ロゴ -->
            <h1><a href="http://127.0.0.1:8000/posts/index"><img src="/images/atlas.png" alt="atlas"></a></h1>
            <!-- ドロップダウンナビ -->
            <nav id="menu">
                <details>
                    <!-- ユーザーネーム、▲アイコン -->
                    <summary>
                        <div id="menuIcon">
                            <p>{{ Auth::user()->username }} さん</p><span class="up_icon"></span>
                        </div>
                    </summary>
                    <!-- ドロップダウン中身 -->
                    <ul class="dropdown_lists">
                        <li><a href="/posts/index">HOME</a></li>
                        <li><a href="/users/{{ Auth::user()->id }}/profile">プロフィール編集</a></li>
                        <li><a href="/logout">ログアウト</a></li>
                    </ul>
                </details>
                <!-- アイコン -->
                <figure><img src="{{ asset('storage/' . Auth::user()->image) }}" class="icon" alt="ユーザーアイコン"></figure>
            </nav>
        </div>
    </header>

    <!-- コンテンツ内容 -->
    <main id="row">
        <div id="container">
            @yield('content')
        </div>
        <!-- サイドバー -->
        <div id="side-bar">
            <!-- フォロー・フォロワーリストへ -->
            <div id="confirm">
                <p>{{ Auth::user()->username }}さんの</p>
                <div class="side_count">
                    <p>フォロー数</p>
                    <p>{{ $following_count->count() }}名</p>
                </div>
                <!-- フォローリストボタン -->
                <div class="side_btn_follow">
                    <button type="button" class="btn btn-primary"><a href="/follows/follow_list">フォローリスト</a></button>
                </div>
                <div class="side_count">
                    <p>フォロワー数</p>
                    <p>{{ $followed_count->count() }}名</p>
                </div>
                <!-- フォロワーリストボタン -->
                <div class="side_btn_follow">
                    <button type="button" class="btn btn-primary"><a href="/follows/follower_list">フォロワーリスト</a></button>
                </div>
            </div>
            <!-- ユーザー検索ボタン -->
            <div class="side_btn_search">
                <button type="button" class="btn btn-primary"><a href="/users/search">ユーザー検索</a></button>
            </div>
        </div>
    </main>

    <!-- footer -->
    <footer>
    </footer>


    <!-- jQuery読み込み -->
    <!-- <script src="JavaScriptファイルのURL"></script> -->
    <script src="{{ asset('js/jquery-3.6.3.min.js') }}"></script>
    <script src="{{ asset('js/script.js') }}"></script>
</body>

</html>
