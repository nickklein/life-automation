<?php

namespace Database\Factories;

use App\Models\ShoppingItems;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Model;
use App\User;
use App\Models\ShoppingPrices;
use App\Models\Stores;
use Faker\Generator as Faker;

class ShoppingItemsFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = ShoppingItems::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $store = Stores::inRandomOrder()->first();

        return [
            'name' => $this->faker->name,
            'store_id' => $store['store_id'],
            'url' => '',
            'user_id' => 1,
        ];
    }
}
