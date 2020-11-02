<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\ShoppingListItems;
use App\Models\ShoppingLists;
use App\Models\ShoppingItems;
use App\User;
use Faker\Generator as Faker;

$factory->define(ShoppingListItems::class, function (Faker $faker) {
    $item = ShoppingItems::inRandomOrder()->first();
    $list = ShoppingLists::inRandomOrder()->first();
    $user = User::inRandomOrder()->first();

    return [
        'item_id' => $item['shopping_item_id'],
        'list_id' => $list['shopping_list_id'],
        'user_id' => $user['id'],
    ];
});
