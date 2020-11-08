<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\ShoppingPrices;
use App\Models\ShoppingItems;
use App\Models\Stores;
use Faker\Generator as Faker;

$factory->define(ShoppingPrices::class, function (Faker $faker) {
    $item = ShoppingItems::inRandomOrder()->first();
    $store = Stores::inRandomOrder()->first();

    return [
        'sh_item_id' => $item['sh_item_id'],
        'amount' => rand(100, 1000),
        'store_id' => $store['store_id'],
        'created_at' => date('Y-m-d H:m:s'),
        'updated_at' => date('Y-m-d H:m:s')
    ];
});
