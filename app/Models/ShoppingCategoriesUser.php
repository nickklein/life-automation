<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ShoppingCategoriesUser extends Model
{
    protected $table = 'shopping_categories_user';
    protected $primaryKey = 'sh_categories_user_id';
    public $timestamps = false;

    protected $fillable = [
        'sh_category_id',
        'user_id',
    ];
}
