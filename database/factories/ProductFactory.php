<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

use App\Models\Product;
use App\Models\Category;
use App\Models\Subcategory;
use App\Models\Subsubcategory;

class ProductFactory extends Factory
{
    protected $model = Product::class;
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $title = $this->faker->word;
        $int = random_int(1, 3);

        return [
            'category_id' => Category::get()->random()->id,
            'subcategory_id' => Subcategory::get()->random()->id,
            'subsubcategory_id' => $int > 2 ? Subsubcategory::get()->random()->id : null,
            'title' => $title,
            'slug' => Str::slug($title, '-'),
            'width' => random_int(10, 1000),
            'length' => random_int(10, 1000),
            'weight' => random_int(1, 50),
            'price' => random_int(1500, 25000),
            'description' => $this->faker->text(500)
        ];
    }
}
