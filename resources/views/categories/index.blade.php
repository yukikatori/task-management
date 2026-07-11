@extends('layouts.app')

@section('content')
    <h1 class="page-title">カテゴリ一覧</h1>

    {{-- コメント表示（登録・編集・削除後） --}}
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if (session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    {{-- 上部ボタン --}}
    <div class="top-actions">
        <a href="{{ route('categories.create') }}" class="btn btn-primary">カテゴリ登録</a>
    </div>

    {{-- カテゴリ一覧テーブル --}}
    <table class="task-table">
        <thead>
            <tr>
                <th>カテゴリ名</th>
                <th class="text-center"></th>
            </tr>
        </thead>

        <tbody>
            @foreach ($categories as $category)
                <tr>
                    <td style="font-weight: bold;">
                            {{ $category->name}}
                    </td>
                    {{-- 操作ボタン --}}
                    <td class="text-center">

                        {{-- 編集 --}}
                            <a href="{{ route('categories.edit', $category) }}" class="btn btn-warning">編集</a>

                        {{-- 削除 --}}
                            <form action="{{ route('categories.destroy', $category) }}" method="POST" class="inline">
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
        {{ $categories->links() }}
    </div>
@endsection
