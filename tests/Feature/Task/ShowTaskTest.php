<?php

namespace Tests\Feature\Task;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Category;
use App\Models\Task;
use App\Models\User;

class ShowTaskTest extends TestCase
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
        $task = $this->task;

        $response = $this->get('/tasks/' . $task->id);

        $response->assertRedirect('/login');
    }

    /** @test */
    public function タイトル、優先度、期日、カテゴリで構成される(): void
    {
        $task = $this->task;

        $response = $this->actingAs($this->user)->get('/tasks/' . $task->id);

        $response->assertSee($task->title);
        $response->assertSee('優先度');
        $response->assertSee('期日');
        $response->assertSee('カテゴリ');
    }
}
