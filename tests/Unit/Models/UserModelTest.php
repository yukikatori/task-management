<?php

namespace Tests\Unit\Models;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Category;
use App\Models\Task;
use App\Models\User;

class UserModelTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function １人のユーザーから紐づくタスクを取得できる(): void
    {
        $user = User::factory()->create();
        Task::factory()->count(3)->create(['user_id' => $user->id]);

        $this->assertCount(3, $user->tasks);
        $this->assertInstanceOf(Task::class, $user->tasks->first());
    }   
}
