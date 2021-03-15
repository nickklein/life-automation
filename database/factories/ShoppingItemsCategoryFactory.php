<?php

namespace Database\Factories;

use App\Models\ShoppingItemsCategory;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\ShoppingItems;
use App\Models\ShoppingCategories;

class ShoppingItemsCategoryFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = ShoppingItemsCategory::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $item = ShoppingItems::inRandomOrder()->first();
        $category = ShoppingCategories::inRandomOrder()->first();
    
        return [
            'sh_item_id' => $item['sh_item_id'],
            'sh_category_id' => $category['sh_category_id'],
            'user_id' => 1,
        ];
    }
}
