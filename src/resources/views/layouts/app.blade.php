<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', '商品管理システム')</title>
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/index.css') }}">
</head>
<body>
    <!-- ヘッダー -->
    <header class="header">
        <div class="container">
            <h1 class="site-title"><a href="/">mogitate</a></h1>
        </div>
    </header>

    <!-- メインコンテンツ -->
    <main class="main-content">
        <div class="container">
            @yield('content')
        </div>
    </main>

    <!-- フッター -->
    <footer class="footer">
        <div class="container">
            <p>&copy; {{ date('Y') }} mogitate. All Rights Reserved.</p>
        </div>
    </footer>
</body>
</html>
