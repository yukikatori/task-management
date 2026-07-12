<?php

namespace Tests\Unit\Models;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Category;
use App\Models\Task;
use App\Models\User;

class TaskModelTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function １つのタスクが特定のユーザーに紐づいている(): void
    {
        $user = User::factory()->create();
        $task = Task::factory()->create(['user_id' => $user->id]);

        $this->assertInstanceOf(User::class, $task->user);
        $this->assertEquals($user->id, $task->user->id);
    }

    /** @test */
    public function 中間テーブルを介して、１つのタスクが複数のカテゴリに紐づいている(): void
    {
        $user = User::factory()->create();
        $task = Task::factory()->create(['user_id' => $user->id]);
        $categories = Category::factory()->count(3)->create();

        foreach ($categories as $category) {
            $task->categories()->attach($category->id);
        }

        foreach ($categories as $category) {
            $this->assertDatabaseHas('category_task', [
                'category_id' => $category->id,
                'task_id' => $task->id,
            ]);
        }

        $this->assertCount(3, $task->categories);
        $this->assertInstanceOf(Category::class, $task->categories->first());
    }
}
