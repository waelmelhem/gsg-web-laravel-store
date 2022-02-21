<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Admin;
use Database\Factories\CategoryFactory;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        Admin::factory(2)->create();
        // \App\Models\User::factory(10)->create();
        // Category::factory(50)->create();
        // $this->call(CategoriesTableSeeder::class);
    }
}
