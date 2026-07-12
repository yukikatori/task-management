<?php

namespace Tests\Feature\Task;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Category;
use App\Models\Task;
use App\Models\User;

class StoreTaskTest extends TestCase
{
    use RefreshDatabase;

    protected User $user;

    protected function setUp(): void
    {
        parent::setUp();

        $this->user = User::factory()->create();
        $this->category = Category::factory()->create();
    }

    /** @test */
    public function 未認証時ログイン画面へリダイレクトする(): void
    {
        $response = $this->get('/tasks/create');

        $response->assertRedirect('/login');
    }

    /** @test */
    public function タイトル、優先度、期日、カテゴリで構成される(): void
    {
        $response = $this->actingAs($this->user)->get('/tasks/create');

        $response->assertSee('タイトル');
        $response->assertSee('優先度');
        $response->assertSee('期日');
        $response->assertSee('カテゴリ');
    }

    /** @test */
    public function タスク登録後、カテゴリが紐づけられタスク一覧画面にリダイレクトする(): void
    {
        $data = [
            'title' => 'test',
            'description' => 'test',
            'priority' => 1,
            'due_date' => '2026-07-12',
            'completed_at' => null,
            'categories' => [$this->category->id],
        ];

        $response = $this->actingAs($this->user)->post('/tasks', $data);

        $response->assertRedirect('/tasks');

        $task = Task::latest()->first();

        $this->assertDatabaseHas('tasks', [
            'title' => 'test',
            'description' => 'test',
            'priority' => 1,
            'due_date' => '2026-07-12',
            'completed_at' => null,
        ]);

        $this->assertDatabaseHas('category_task', [
            'task_id' => $task->id,
            'category_id' => $this->category->id,
        ]);
    }
}
