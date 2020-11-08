<?php

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
        factory(ShoppingItems::class, 25)->create();
    }
}
