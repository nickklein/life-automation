<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ShoppingItemsCategory extends Model
{
    protected $table = 'shopping_items_category';
    protected $primaryKey = 'sh_items_category_id';
    public $timestamps = false;

    protected $fillable = [
        'sh_item_id',
        'sh_category_id',
        'user_id',
        'created_at',
        'updated_at',
    ];
}
