<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use \App\Models\ShoppingItemsCategory;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ShoppingItemsCategorySeeder extends Seeder
{
    use HasFactory;
    
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ShoppingItemsCategory::factory()->count(25)->create();
    }
}
