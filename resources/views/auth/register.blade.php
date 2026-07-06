@extends('layouts.app')

@section('content')
<div class="auth-container">
    <h2>会員登録</h2>

    <form method="POST" action="{{ route('register') }}" novalidate>
        @csrf

        <label for="name">名前</label>
        <input id="name" type="text" name="name" value="{{ old('name') }}">
        @error('name')
            <div class="error-message">{{ $message }}</div>
        @enderror

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

        <label for="password_confirmation">パスワード（確認）</label>
        <input id="password_confirmation" type="password" name="password_confirmation">

        <button type="submit" class="btn-primary">会員登録</button>

        <div class="auth-link">
            <a href="{{ route('login') }}">ログインはこちら</a>
        </div>
    </form>
</div>
@endsection

