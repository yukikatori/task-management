<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'TaskViewer' }}</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>
    <header class="header">
        <div class="header-left">
            <img src="{{ asset('images/logo.png') }}" alt="Logo" class="logo" width="200" height="60">
        </div>

        <nav class="header-right">
            <a href="{{ route('tasks.index') }}">タスク一覧</a>
            <a href="{{ route('categories.index') }}">カテゴリー一覧</a>
            @auth
                <form method="POST" action="{{ route('logout') }}" style="display:inline;">
                    @csrf
                    <button type="submit" class="logout-btn">ログアウト</button>
                </form>
            @endauth
        </nav>
    </header>

    <main class="main-content">
        @yield('content')
    </main>
</body>
</html>

