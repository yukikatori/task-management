<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use App\Models\Category;
use App\Models\Task;
use App\Http\Requests\StoreTaskRequest;

class TaskController extends Controller
{
    public function index(): View
    {
        $tasks = auth()->user()->tasks()
            ->with('categories')
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('tasks.index', compact('tasks'));
    }

    public function show(Task $task): View
    {
        $task->load('categories');

        return view('tasks.show', compact('task'));
    }

    public function create(): View
    {
        $categories = Category::orderBy('created_at', 'desc')
            ->get();

        return view('tasks.create', compact('categories'));
    }

    public function store(StoreTaskRequest $request): RedirectResponse
    {
        $validated = $request->validated();

        $task = Task::create([
            'title' => $validated['title'],
            'description' => $validated['description'],
            'priority' => $validated['priority'],
            'due_date' => $validated['due_date'],
            'completed_at' => null,
            'user_id' => auth()->id(),
        ]);

        $task->categories()->sync($validated['categories']);

        return redirect()
            ->route('tasks.index')
            ->with('success', 'タスクを登録しました');
    }
}
