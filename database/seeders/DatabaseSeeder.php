<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use App\Models\User;
use App\Models\Category;
use App\Models\Subcategory;
use App\Models\Subsubcategory;
use App\Models\Product;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        User::factory(3)->create();
        Category::factory(10)->create();
        Subcategory::factory(20)->create();
        Subsubcategory::factory(40)->create();
        Product::factory(200)->create();
    }
}
