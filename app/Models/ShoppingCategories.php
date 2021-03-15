<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ShoppingCategories extends Model
{
    use HasFactory;
    
    protected $table = 'shopping_categories';
    protected $primaryKey = 'sh_category_id';
    public $timestamps = false;

    protected $fillable = [
        'name',
    ];
}
