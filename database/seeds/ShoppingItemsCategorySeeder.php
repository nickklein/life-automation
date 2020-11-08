<?php

use Illuminate\Database\Seeder;
use \App\Models\ShoppingItemsCategory;

class ShoppingItemsCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(ShoppingItemsCategory::class, 25)->create();
    }
}
