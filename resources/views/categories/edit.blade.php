@extends('layouts.app')

@section('content')
    <h1 class="page-title">カテゴリ編集</h1>

    {{-- 編集フォーム --}}
    <form action="{{ route('categories.update', $category) }}" method="POST" class="task-form" novalidate>
        @csrf
        @method('PUT')

        {{-- カテゴリ名 --}}
            <label for="title">カテゴリ名</label>
            <input type="text" name="name" id="name"
                value="{{ old('name', $category->name) }}" class="form-control">
        @error('name')
            <div class="error-message">{{ $message }}</div>
        @enderror

        {{-- 編集ボタン --}}
        <div>
            <button type="submit" class="btn btn-third">編集</button>
        </div>

        {{-- 戻るボタン --}}
        <div>
            <a href="{{ route('categories.index') }}" class="btn btn-secondary">カテゴリ一覧へ戻る</a>
        </div>
    </form>
@endsection
