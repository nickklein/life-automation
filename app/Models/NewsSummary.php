<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NewsSummary extends Model
{
    protected $table = 'news_summary';
    protected $primaryKey = 'summary_id';

    public function tags() {
    	return $this->hasOne('\App\Models\Tags', 'tag_id', 'tag_id');
    }
}
