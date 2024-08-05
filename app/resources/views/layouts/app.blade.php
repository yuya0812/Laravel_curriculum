<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body>
    <header>
        <nav>
            <ul>
                <li><a href="{{ route('home') }}">ホーム</a></li>
                <li><a href="{{ route('spots') }}">観光スポット</a></li>
                <li><a href="{{ route('gourmet') }}">グルメ</a></li>
                <li><a href="{{ route('search') }}">投稿検索</a></li>
                <li><a href="{{ route('mypage') }}">マイページ</a></li>
                <li><a href="{{ route('admin') }}">管理者ページ</a></li>
            </ul>
        </nav>
    </header>
    <main>
        @yield('content')
    </main>
    <footer>
        <p>&copy; 2024 Fukui Travel Guide</p>
    </footer>
</body>
</html>
