<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DeviceSettings extends Model
{
    //
    protected $table = 'device_settings';
    protected $primaryKey = 'device_settings_id';
    public $timestamps = false;
}
