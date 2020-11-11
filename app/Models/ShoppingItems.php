<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ShoppingItems extends Model
{
    protected $table = 'shopping_items';
    protected $primaryKey = 'sh_item_id';
    public $timestamps = false;

    protected $fillable = [
        'name',
        'url',
        'amount',
        'grams',
        'ml',
        'price',
        'store_id',
        'user_id',
    ];
}
