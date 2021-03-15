<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Stores;

class StoreSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Stores::factory()->count(3)->create();
    }
}
