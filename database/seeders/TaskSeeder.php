<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;
use App\Models\Task;
use App\Models\User;

class TaskSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = User::all();

        // 未完了タスクの投入
        foreach ($users as $user) {
            Task::factory()->count(rand(3, 5))->create([
                'completed_at' => null,
                'user_id' => $user->id,
            ]);
        }

        // 完了済みタスクの投入
        foreach ($users as $user) {
            Task::factory()->count(rand(1, 2))->create([
                'completed_at' => now(),
                'user_id' => $user->id,
            ]);
        }

        // カテゴリ紐づけ
        $tasks = Task::all();

        foreach ($tasks as $task) {
            $selectedCategories = Category::inRandomOrder()->take(rand(1, 2))->get();

            $task->categories()->syncWithoutDetaching($selectedCategories->pluck('id'));
        }
    }
}
