<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ShoppingListItems extends Model
{
    protected $table = 'shopping_list_items';
    protected $primaryKey = 'list_items_id';
    public $timestamps = false;
}
