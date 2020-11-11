<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\ShoppingCategories;
use Faker\Generator as Faker;

$factory->define(ShoppingCategories::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
    ];
});
