<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ShoppingLists extends Model
{
    protected $table = 'shopping_lists';
    protected $primaryKey = 'shopping_list_id';
    public $timestamps = false;
}
