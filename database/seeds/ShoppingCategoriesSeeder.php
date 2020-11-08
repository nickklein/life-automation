<?php

use Illuminate\Database\Seeder;
use \App\Models\ShoppingCategories;

class ShoppingCategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(ShoppingCategories::class, 100)->create();
    }
}
