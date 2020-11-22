<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserSources extends Model
{
    protected $table = 'user_sources';
    protected $primaryKey = 'user_sources_id';
    public $timestamps = false;
}
