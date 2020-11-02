<?php

namespace App\Services;

use App\Repositories\ShoppingRepository;

class ShoppingService
{
   private $shoppingRepository;

   public function __construct(ShoppingRepository $shoppingRepository)
   {
      $this->shoppingRepository = $shoppingRepository;
   }

    /**
     * Get users shopping list
     *
     * @return bool
     */
     public function list(int $userId)
     {
         return $this->shoppingRepository->list($userId);
     }
}