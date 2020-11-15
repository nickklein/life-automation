<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SourcesFavourites extends Model
{
    protected $table = 'sources_favorites';
    protected $primaryKey = 'sources_favorites_id';
    public $timestamps = false;

    public $fillable = [
        'source_link_id',
        'user_id',
    ];
}
