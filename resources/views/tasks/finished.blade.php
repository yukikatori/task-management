@extends('layouts.app')

@section('content')
    <h1 class="page-title">完了タスク一覧</h1>

    {{-- コメント表示（登録・編集・削除後） --}}
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    {{-- タスク一覧テーブル --}}
    <table class="task-table">
        <thead>
            <tr>
                <th>タイトル</th>
                <th>完了日</th>
                <th>カテゴリ</th>
            </tr>
        </thead>

        <tbody>
            @foreach ($tasks as $task)
                <tr>
                    <td style="font-weight: bold;">
                            {{ $task->title }}
                    </td>

                    {{-- 完了日 --}}
                    <td>
                        {{ $task->completed_at ? $task->completed_at->format('Y/m/d') : '未設定' }}
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
                </tr>
            @endforeach
        </tbody>
    </table>

    {{-- ページネーション --}}
    <div class="pagination-area">
        {{ $tasks->links() }}
    </div>
@endsection
