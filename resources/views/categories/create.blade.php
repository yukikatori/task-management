@extends('layouts.app')

@section('content')
    <h1 class="page-title">カテゴリ登録</h1>

    <form action="{{ route('categories.store') }}" method="POST" class="task-form" novalidate>
        @csrf

        {{-- カテゴリ名 --}}
        <label for="title">カテゴリ名</label>
        <input type="text" name="name" id="name" value="{{ old('name') }}" required>
        @error('name')
            <div class="error-message">{{ $message }}</div>
        @enderror

        {{-- 登録ボタン --}}
        <div>
            <button type="submit" class="btn btn-third">登録</button>
        </div>

        {{-- 戻るボタン --}}
        <div>
            <a href="{{ route('categories.index') }}" class="btn btn-secondary">カテゴリ一覧へ戻る</a>
        </div>
    </form>
@endsection
