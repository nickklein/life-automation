<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use \App\Models\ShoppingItems;

class ShoppingItemsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ShoppingItems::factory()->count(25)->create();
    }
}
