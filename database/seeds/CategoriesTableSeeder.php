<?php

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategoriesTableSeeder extends Seeder
{
    public function run()
    {
        Category::create(['name' => 'Приветствие']);
        Category::create(['name' => 'Рассказ']);
        Category::create(['name' => 'Что-то другое']);
    }
}
