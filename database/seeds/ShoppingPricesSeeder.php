<?php

use Illuminate\Database\Seeder;
use \App\Models\ShoppingPrices;

class ShoppingPricesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(ShoppingPrices::class, 25)->create();
    }
}
