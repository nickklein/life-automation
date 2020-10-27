<?php

use Illuminate\Database\Seeder;

class ShoppingPricesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(\App\Models\ShoppingPrices::class, 500)->create();
    }
}
