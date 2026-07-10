@extends('layouts.app')

@section('content')
    <h1 class="page-title">タスク編集</h1>

    {{-- 編集フォーム --}}
    <form action="{{ route('tasks.update', $task) }}" method="POST" class="task-form" novalidate>
        @csrf
        @method('PUT')

        {{-- タイトル --}}
            <label for="title">タイトル</label>
            <input type="text" name="title" id="title"
                value="{{ old('title', $task->title) }}" class="form-control">
        @error('title')
            <div class="error-message">{{ $message }}</div>
        @enderror

        {{-- 説明 --}}
            <label for="description">説明</label>
            <textarea name="description" id="description" rows="4" class="form-control">{{ old('description', $task->description) }}</textarea>
        @error('description')
            <div class="error-message">{{ $message }}</div>
        @enderror

        {{-- 優先度 --}}
            <label for="priority">優先度</label>
            <select name="priority" id="priority" class="form-control">
                <option value="1" {{ old('priority', $task->priority->value) == 1 ? 'selected' : '' }}>高</option>
                <option value="2" {{ old('priority', $task->priority->value) == 2 ? 'selected' : '' }}>中</option>
                <option value="3" {{ old('priority', $task->priority->value) == 3 ? 'selected' : '' }}>低</option>
            </select>
        @error('priority')
            <div class="error-message">{{ $message }}</div>
        @enderror

        {{-- 期日 --}}
            <label for="due_date">期日</label>
            <input type="date" name="due_date" id="due_date"
                value="{{ old('due_date', $task->due_date ? $task->due_date->format('Y-m-d') : '') }}"
                class="form-control">
        @error('due_date')
            <div class="error-message">{{ $message }}</div>
        @enderror

        {{-- カテゴリ（チェックボックス） --}}
            <label>カテゴリ</label>
            <div class="category-checkboxes">
            @foreach ($categories as $category)
                <label>
                    <input type="checkbox" name="categories[]" value="{{ $category->id }}"
                        {{ in_array($category->id, old('categories', $task->categories->pluck('id')->toArray())) ? 'checked' : '' }}>
                    {{ $category->name }}
                </label>
            @endforeach
            </div>
        @error('categories')
            <div class="error-message">{{ $message }}</div>
        @enderror

        {{-- 編集ボタン --}}
        <div>
            <button type="submit" class="btn btn-third">編集</button>
        </div>

        {{-- 戻るボタン --}}
        <div>
            <a href="{{ route('tasks.index') }}" class="btn btn-secondary">タスク一覧へ戻る</a>
        </div>
    </form>
@endsection
