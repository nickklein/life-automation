<?php

use Illuminate\Database\Seeder;
use App\Models\DeviceSettings;

class DeviceSettingsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        /*
            $table->bigIncrements('device_settings_id');
            $table->string('key', 500);
            $table->string('value', 500);
            $table->mediumInteger('device_id')->nullable()->unsigned();
        */
        $devices_settings = array(
            array('key' => 'FTPS', 'value' => 1, 'device_id' => 1),
            array('key' => 'SFTP', 'value' => 1, 'device_id' => 1),
            array('key' => 'FTPS', 'value' => 1, 'device_id' => 2),
            array('key' => 'SFTP', 'value' => 1, 'device_id' => 2),
            array('key' => 'FTPS', 'value' => 1, 'device_id' => 3),
            array('key' => 'SFTP', 'value' => 1, 'device_id' => 3),
            array('key' => 'FTPS', 'value' => 1, 'device_id' => 4),
            array('key' => 'SFTP', 'value' => 1, 'device_id' => 4),
            array('key' => 'FTPS', 'value' => 1, 'device_id' => 5),
            array('key' => 'SFTP', 'value' => 1, 'device_id' => 5),
        );
        DeviceSettings::insert($devices_settings);
    }
}
