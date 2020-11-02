<?php

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
        $insert = [
            ['name' => 'Save On Foods'],
            ['name' => 'Walmart'],
        ];
        Stores::insert($insert);
    }
}
