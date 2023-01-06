<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

use App\Models\Category;
use App\Models\Subcategory;

class SubcategoryFactory extends Factory
{
    protected $model = Subcategory::class;
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'category_id' => Category::get()->random()->id,
            'title' => $this->faker->word
        ];
    }
}
