@extends('layouts.app')

@section('content')
    <h1 class="page-title">タスク詳細</h1>

    <div class="task-detail">
        {{-- タイトル --}}
        <h2 class="task-title">{{ $task->title }}</h2>

        {{-- 説明 --}}
        <p class="task-description"><strong>説明：</strong>{{ $task->description }}</p>

        {{-- 優先度 --}}
        <p>
            <strong>優先度：</strong>
            <span class="priority-badge priority-{{ $task->priority->color() }}">
                {{ $task->priority->label() }}
            </span>
        </p>

        {{-- 登録日 --}}
        <p><strong>登録日：</strong> {{ $task->created_at->format('Y/m/d') }}</p>

        {{-- 期日 --}}
        <p><strong>期日：</strong> {{ $task->due_date ? $task->due_date->format('Y/m/d') : '未設定' }}</p>

        {{-- カテゴリ --}}
        <p>
            <strong>カテゴリ：</strong>
            @foreach ($task->categories as $category)
                <span class="category-badge">{{ $category->name }}</span>
            @endforeach
            @if ($task->categories->isEmpty())
                未分類
            @endif
        </p>

        {{-- 戻るボタン --}}
        <div class="back-button">
            <a href="{{ route('tasks.index') }}" class="btn btn-secondary">タスク一覧へ戻る</a>
        </div>
    </div>
@endsection
