<?php

namespace App\Repositories;

use App\Models\ShoppingLists;

class ShoppingRepository
{
    public function list($userId)
    {
        return ShoppingLists::where('user_id', $userId)
                            ->get();
    }
}