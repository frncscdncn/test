<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

use App\Models\Subcategory;
use App\Models\Subsubcategory;

class SubsubcategoryFactory extends Factory
{
    protected $model = Subsubcategory::class;
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'subcategory_id' => Subcategory::get()->random()->id,
            'title' => $this->faker->word
        ];
    }
}
