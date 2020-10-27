<?php

use Illuminate\Database\Seeder;

class ShoppingItemsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(\App\Models\ShoppingItems::class, 500)->create();
    }
}
