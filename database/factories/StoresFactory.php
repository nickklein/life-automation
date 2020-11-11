<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Stores;
use Faker\Generator as Faker;

$factory->define(Stores::class, function (Faker $faker) {
    return [
        'name' => $faker->name
    ];
});
