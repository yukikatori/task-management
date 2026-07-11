<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use App\Models\Category;
use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;

class CategoryController extends Controller
{
    public function index(): View
    {
        $categories = Category::orderBy('created_at', 'desc')
            ->paginate(10);

        return view('categories.index', compact('categories'));
    }

    public function create(): View
    {
        return view('categories.create');
    }

    public function store(StoreCategoryRequest $request): RedirectResponse
    {
        $validated = $request->validated();

        Category::create([
            'name' => $validated['name'],
        ]);

        return redirect()
            ->route('categories.index')
            ->with('success', 'カテゴリを登録しました');
    }

    public function edit(Category $category): RedirectResponse|View
    {
        if ($category->tasks()->exists()) {
            return redirect()
                ->route('categories.index')
                ->with('error', 'このカテゴリにはタスクが紐づいているので編集できません');
        }

        return view('categories.edit', compact('category'));
    }

    public function update(UpdateCategoryRequest $request, Category $category): RedirectResponse
    {
        if ($category->tasks()->exists()) {
            return redirect()
                ->route('categories.index')
                ->with('error', 'このカテゴリにはタスクが紐づいているので編集できません');
        }

        $validated = $request->validated();

        $category->update([
            'name' => $validated['name'],
        ]);

        return redirect()
            ->route('categories.index')
            ->with('success', 'カテゴリを編集しました');
    }

    public function destroy(Category $category): RedirectResponse
    {
        if ($category->tasks()->exists()) {
            return redirect()
                ->route('categories.index')
                ->with('error', 'このカテゴリにはタスクが紐づいているので削除できません');
        }

        $category->delete();

        return redirect()
            ->route('categories.index')
            ->with('success', 'カテゴリを削除しました');
    }
}
