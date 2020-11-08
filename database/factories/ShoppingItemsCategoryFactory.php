<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\ShoppingItemsCategory;
use App\Models\ShoppingCategories;
use App\Models\ShoppingItems;
use Faker\Generator as Faker;

$factory->define(ShoppingItemsCategory::class, function (Faker $faker) {
    $item = ShoppingItems::inRandomOrder()->first();
    $category = ShoppingCategories::inRandomOrder()->first();

    return [
        'sh_item_id' => $item['sh_item_id'],
        'sh_category_id' => $category['sh_category_id'],
        'user_id' => 1,
    ];
});
