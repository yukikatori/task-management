<?php

namespace Tests\Unit\Models;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Category;
use App\Models\Task;
use App\Models\User;

class CategoryModelTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function 中間テーブルを介して、１つのカテゴリが複数のタスクに紐づいている(): void
    {
        $user = User::factory()->create();
        $tasks = Task::factory()->count(3)->create(['user_id' => $user->id]);
        $category = Category::factory()->create(['name' => 'test']);

        $category->tasks()->attach($tasks->pluck('id'));

        foreach ($tasks as $task) {
            $this->assertDatabaseHas('category_task', [
                'category_id' => $category->id,
                'task_id' => $task->id,
            ]);
        }

        $this->assertCount(3, $category->tasks);
        $this->assertInstanceOf(Task::class, $category->tasks->first());
    }  
}
