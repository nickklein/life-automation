<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ShoppingItems extends Model
{
    use HasFactory;
    
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
