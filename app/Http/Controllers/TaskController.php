<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Models\Task;

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
}
