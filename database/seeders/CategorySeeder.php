<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            ['name' => 'Admit Card',       'slug' => 'admit-card'],
            ['name' => 'Result',           'slug' => 'result'],
            ['name' => 'Job Notification', 'slug' => 'job-notification'],
            ['name' => 'Tech Tutorials',   'slug' => 'tech-tutorials'],
        ];

        foreach ($categories as $cat) {
            Category::create($cat);
        }
    }
}
