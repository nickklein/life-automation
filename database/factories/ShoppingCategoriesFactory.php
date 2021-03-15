<?php

namespace Database\Factories;

use App\Models\ShoppingCategories;
use Illuminate\Database\Eloquent\Factories\Factory;
use Faker\Generator as Faker;

class ShoppingCategoriesFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = ShoppingCategories::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name,
        ];
    }
}
