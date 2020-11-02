<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use App\Models\ShoppingItems;
use Faker\Generator as Faker;

$factory->define(ShoppingItems::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'walmart' => '',
        'saveonfood' => '',
    ];
});
