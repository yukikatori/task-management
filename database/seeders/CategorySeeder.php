<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            ['name' => '仕事'],
            ['name' => 'プライベート'],
            ['name' => '勉強'],
            ['name' => '家事'],
            ['name' => '健康'],
            ['name' => '趣味'],
        ];

        foreach ($categories as $category) {
            Category::firstOrCreate(
                ['name' => $category['name']],
                $category,
            );
        }
    }
}
