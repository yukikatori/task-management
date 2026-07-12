<?php

namespace Tests\Feature\Task;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Category;
use App\Models\Task;
use App\Models\User;

class IndexTaskTest extends TestCase
{
    use RefreshDatabase;

    protected User $user;

    protected function setUp(): void
    {
        parent::setUp();

        $this->user = User::factory()->create();
        $this->category = Category::factory()->create();
        $this->task = Task::factory()->create([
            'user_id' => $this->user->id,
        ]);
    }

    /** @test */
    public function 未認証時ログイン画面へリダイレクトする(): void
    {
        $response = $this->get('/tasks');

        $response->assertRedirect('/login');
    }

    /** @test */
    public function タスク一覧が１０件／ページでページネーション表示され、各タスクにカテゴリが紐づく(): void
    {
        $tasks = Task::factory()->count(15)->create([
            'user_id' => $this->user->id,
        ]);

        $categories = Category::factory()->count(2)->create();

        foreach ($tasks as $task) {
            $task->categories()->attach($categories->pluck('id'));
        }

        $response = $this->actingAs($this->user)->get('/tasks');

        $response->assertViewHas('tasks', function ($viewTasks) {
            return $viewTasks->count() === 10;
        });

        $response->assertSee('page=2');

        $response->assertViewHas('tasks', function ($viewTasks) {
            return $viewTasks->every(fn ($task) => $task->categories->isNotEmpty());
        });
    }

    /** @test */
    public function タイトル、優先度、期日、カテゴリで構成される(): void
    {
        $response = $this->actingAs($this->user)->get('/tasks');

        $response->assertSee('タイトル');
        $response->assertSee('優先度');
        $response->assertSee('期日');
        $response->assertSee('カテゴリ');
    }

    /** @test */
    public function タスクは新しい順で表示される(): void
    {
        $newTask = Task::factory()->create([
            'user_id' => $this->user->id,
            'created_at' => now(),
        ]);

        $oldTask = Task::factory()->create([
            'user_id' => $this->user->id,
            'created_at' => now()->subDay(),
        ]);

        $newTask->categories()->attach($this->category->id);
        $oldTask->categories()->attach($this->category->id);

        $response = $this->actingAs($this->user)->get('/tasks');

        $response->assertSeeInOrder([
            $newTask->title,
            $oldTask->title,
        ]);
    }

    /** @test */
    public function 完了、編集、削除ボタンが表示される(): void
    {
        $task = $this->task;

        $response = $this->actingAs($this->user)->get('/tasks');

        $response->assertSee('完了');
        $response->assertSee('編集');
        $response->assertSee('削除');
    }
}
