@extends('layouts.app')

@section('content')
<div class="auth-container">
    <h2>ログイン</h2>

    <form method="POST" action="{{ route('login') }}" novalidate>
        @csrf

        <label for="email">メールアドレス</label>
        <input id="email" type="email" name="email" value="{{ old('email') }}">
        @error('email')
            <div class="error-message">{{ $message }}</div>
        @enderror

        <label for="password">パスワード</label>
        <input id="password" type="password" name="password">
        @error('password')
            <div class="error-message">{{ $message }}</div>
        @enderror

        <button type="submit" class="btn-primary">ログイン</button>

        <div class="auth-link">
            <a href="{{ route('register') }}">新規会員登録はこちら</a>
        </div>
    </form>
</div>
@endsection
