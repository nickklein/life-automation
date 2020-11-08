<?php

use Illuminate\Database\Seeder;
use App\Models\Cities;

class CitiesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $insert = array(
            array('city_name' => 'Vancouver', 'lat' => 49.2497, 'lon' => -123.1193),
            array('city_name' => 'Munich', 'lat' => 48.1374, 'lon' => 11.5755),
        );
        Cities::insert($insert);
    }
}
