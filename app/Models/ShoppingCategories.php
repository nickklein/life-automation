<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ShoppingCategories extends Model
{
    protected $table = 'shopping_categories';
    protected $primaryKey = 'sh_category_id';
    public $timestamps = false;

    protected $fillable = [
        'name',
    ];
}
