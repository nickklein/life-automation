<?php

use Illuminate\Database\Seeder;
use App\Models\Devices;


class DeviceTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $devices = array(
            array('device_name' => 'PC #1', 'user_id' => 1, 'last_online' => '2019-06-24 00:00:00'),
            array('device_name' => 'PC #2', 'user_id' => 1, 'last_online' => '2019-06-24 00:00:00'),
            array('device_name' => 'PC #3', 'user_id' => 1, 'last_online' => '2019-06-24 00:00:00'),
            array('device_name' => 'PC #4', 'user_id' => 1, 'last_online' => '2019-06-24 00:00:00'),
        );
        Devices::insert($devices);
    }
}
