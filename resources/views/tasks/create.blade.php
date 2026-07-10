@extends('layouts.app')

@section('content')
    <h1 class="page-title">タスク登録</h1>

    <form action="{{ route('tasks.store') }}" method="POST" class="task-form" novalidate>
        @csrf

        {{-- タイトル --}}
        <label for="title">タイトル</label>
        <input type="text" name="title" id="title" value="{{ old('title') }}" required>
        @error('title')
            <div class="error-message">{{ $message }}</div>
        @enderror

        {{-- 説明 --}}
        <label for="description">説明</label>
        <textarea name="description" id="description" rows="4">{{ old('description') }}</textarea>
        @error('description')
            <div class="error-message">{{ $message }}</div>
        @enderror

        {{-- 優先度 --}}
        <label for="priority">優先度</label>
        <select name="priority" id="priority">
            <option value="1" {{ old('priority') === '1' ? 'selected' : '' }}>高</option>
            <option value="2" {{ old('priority') === '2' ? 'selected' : '' }}>中</option>
            <option value="3" {{ old('priority') === '3' ? 'selected' : '' }}>低</option>
        </select>
        @error('priority')
            <div class="error-message">{{ $message }}</div>
        @enderror

        {{-- 期日 --}}
        <label for="due_date">期日</label>
        <input type="date" name="due_date" id="due_date" value="{{ old('due_date') }}">
        @error('due_date')
            <div class="error-message">{{ $message }}</div>
        @enderror

        {{-- カテゴリ（チェックボックス） --}}
        <label>カテゴリ</label>
        <div class="category-checkboxes">
            @foreach ($categories as $category)
                <label>
                    <input type="checkbox" name="categories[]" value="{{ $category->id }}"
                        {{ in_array($category->id, old('categories', [])) ? 'checked' : '' }}>
                    {{ $category->name }}
                </label>
            @endforeach
        </div>
        @error('categories')
            <div class="error-message">{{ $message }}</div>
        @enderror

        {{-- 登録ボタン --}}
        <div>
            <button type="submit" class="btn btn-third">登録</button>
        </div>

        {{-- 戻るボタン --}}
        <div>
            <a href="{{ route('tasks.index') }}" class="btn btn-secondary">タスク一覧へ戻る</a>
        </div>
    </form>
@endsection
