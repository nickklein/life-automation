<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserTags extends Model
{
    protected $table = 'user_tags';
    protected $primaryKey = 'user_tags_id';
    public $timestamps = false;

    protected $fillable = [
        'tag_id',
        'user_id',
    ];

    public function tag() {
    	return $this->hasOne('\App\Models\Tags', 'tag_id', 'tag_id');
    }
}
