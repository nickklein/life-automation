<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ShoppingItems extends Model
{
    protected $table = 'shopping_items';
    protected $primaryKey = 'shopping_item_id';
    public $timestamps = false;
}
