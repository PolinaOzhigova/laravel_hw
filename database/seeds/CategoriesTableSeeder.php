<?php

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategoriesTableSeeder extends Seeder
{
    public function run()
    {
        Category::create(['name' => 'Как нарисовать?']);
        Category::create(['name' => 'Как пользоваться материалом?']);
        Category::create(['name' => 'Отзывы на определенные материалы']);
        Category::create(['name' => 'Полезные советы']);
        Category::create(['name' => 'Идеи']);
        Category::create(['name' => 'Академический рисунок']);
    }
}
