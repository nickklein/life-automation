<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use App\User;
use App\Models\ShoppingPrices;
use App\Models\ShoppingItems;
use App\Models\Stores;
use Faker\Generator as Faker;

$factory->define(ShoppingItems::class, function (Faker $faker) {
    $store = Stores::inRandomOrder()->first();

    return [
        'name' => $faker->name,
        'store_id' => $store['store_id'],
        'url' => '',
        'user_id' => 1,
    ];
});
