<?php

namespace Database\Seeders;

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
        ShoppingCategories::factory()->count(100)->create();
    }
}
