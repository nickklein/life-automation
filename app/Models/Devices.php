<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Devices extends Model
{
    //
    protected $table = 'devices';
    protected $primaryKey = 'device_id';

    public function device_settings()
    {
        return $this->hasMany('App\Models\DeviceSettings', 'device_id', 'device_id');
    }
}
