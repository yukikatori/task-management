@extends('layouts.app')

@section('content')
    <h1 class="page-title">タスク一覧</h1>

    {{-- コメント表示（登録・編集・削除後） --}}
    @if (session('comment'))
        <div class="alert alert-success">
            {{ session('comment') }}
        </div>
    @endif

    {{-- 上部ボタン --}}
    <div class="top-actions">
        <a href="{{ route('tasks.create') }}" class="btn btn-primary">タスク登録</a>
        <a href="{{ route('tasks.finished') }}" class="btn btn-primary">完了タスク</a>
    </div>

    {{-- タスク一覧テーブル --}}
    <table class="task-table">
        <thead>
            <tr>
                <th>タイトル</th>
                <th>優先度</th>
                <th>期日</th>
                <th>カテゴリ</th>
                <th class="text-center">操作</th>
            </tr>
        </thead>

        <tbody>
            @foreach ($tasks as $task)
                <tr>
                    <td style="font-weight: bold;">{{ $task->title }}</td>

                    {{-- 優先度（例：高・中・低） --}}
                    <td>
                        <span class="priority-badge" style="background-color: {{ $task->priority->color() }}">
                            {{ $task->priority->label() }}
                        </span>
                    </td>

                    {{-- 期日 --}}
                    <td>
                        {{ $task->due_date ? $task->due_date->format('Y/m/d') : '未設定' }}
                    </td>

                    {{-- カテゴリ --}}
                    <td>
                        @foreach ($task->categories as $category)
                            <span class="category-badge">{{ $category->name }}</span>
                        @endforeach

                        @if ($task->categories->isEmpty())
                            未分類
                        @endif
                    </td>

                    {{-- 操作ボタン --}}
                    <td class="text-center">

                        {{-- 完了 --}}
                        <form action="{{ route('tasks.complete', $task) }}" method="POST" class="inline">
                            @csrf
                            <button class="btn btn-success">完了</button>
                        </form>

                        {{-- 編集 --}}
                        <a href="{{ route('tasks.edit', $task) }}" class="btn btn-warning">編集</a>

                        {{-- 削除 --}}
                        <form action="{{ route('tasks.destroy', $task) }}" method="POST" class="inline">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger"
                                onclick="return confirm('削除しますか？')">削除</button>
                        </form>

                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    {{-- ページネーション --}}
    <div class="pagination-area">
        {{ $tasks->links() }}
    </div>
@endsection
