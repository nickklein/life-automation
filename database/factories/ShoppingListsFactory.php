<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\ShoppingLists;
use App\User;
use Faker\Generator as Faker;

$factory->define(ShoppingLists::class, function (Faker $faker) {
    $user = User::inRandomOrder()->first();

    return [
        'name' => $faker->name,
        'user_id' => $user['id'],
    ];
});
