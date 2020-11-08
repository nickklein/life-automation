<?php

namespace App\Services;

use App\Repositories\ShoppingRepository;
use App\Models\ShoppingCategories;
use App\Models\ShoppingCategoriesUser;
use App\Models\ShoppingItems;
use App\Models\ShoppingPrices;
use App\Models\ShoppingItemsCategory;
use App\Services\LogsService;

class ShoppingService
{
   private $shoppingRepository;

   public function __construct(ShoppingRepository $shoppingRepository)
   {
      $this->shoppingRepository = $shoppingRepository;
   }

    /**
     * Get users items list
     *
     * @return bool
     */
     public function items(int $userId): object
     {
         return $this->shoppingRepository->items($userId);
     }

    /**
     * Get users items list
     *
     * @return bool
     */
    public function item(int $itemId, int $userId): object
    {
        // Get Item
            // Get category if it's optional
        $item = $this->shoppingRepository->item($itemId, $userId);
        $itemCategory = $this->shoppingRepository->getItemCategory($item->sh_item_id, $userId);
        if (!empty($itemCategory['sh_category_id'])) {
            $item->category_id = $itemCategory['sh_category_id'];
        }

        return $item;
    }

    /**
     * Return categorized items
     *
     * @return collection
     */
    public function categorizedItems(int $categoryId, int $userId)
    {
        return $this->shoppingRepository->categorizedItems($categoryId, $userId);
    }



    /**
     * Get all categories for a user
     *
     * @return bool
     */
    public function categories(int $userId): object
    {
        return $this->shoppingRepository->categories($userId);
    }

    /**
     * Find category list for user
     *
     * @return bool
     */
    public function category(int $categoryId, int $userId, bool $shoppingItems = false): object
    {
        try {
            $category = $this->shoppingRepository->category($categoryId, $userId);
            if ($shoppingItems) {
                $category->items = $this->categorizedItems($category->sh_category_id, $category->user_id);
                $category->items->map(function($item) {
                    $item->price = 'N/A';
                    $price = ShoppingPrices::where('sh_item_id', $item->sh_item_id)->first();
                    if ($price) {
                        $item->price = '$'.($price['amount']/10);
                    }
                    return $item;
                });
            }
        } catch (\Throwable $th) {
            (new LogsService)->handle('error.updateItems', 'Error while updating Items ' . $th->getMessage());
        }
        
        return $category;
    }


    /**
     * Get stores category
     *
     * @return array
     */
    public function storeCategory(int $userId, string $name): array
    {
        $categories = ShoppingCategories::firstOrCreate(['name' => $name]);
        $categoryUser = ShoppingCategoriesUser::firstOrCreate(
            ['sh_category_id' => $categories->sh_category_id, 'user_id' => $userId]
        );

        if (!$categoryUser) {
            return [];
        }
        
        return $categoryUser->toArray(); 
    }

    /**
     * Update category
     *
     * @return array
     */
    public function updateCategory(int $userId, int $categoryId, string $name): array
    {
        $categories = ShoppingCategories::firstOrCreate(['name' => $name]);
        $categoryUser = ShoppingCategoriesUser::where(
            ['sh_category_id' => $categoryId, 'user_id' => $userId]
        )->first();

        if (!$categoryUser) {
            return [];
        }

        $changed = $categoryUser->update(['sh_category_id' => $categories->sh_category_id]);
        if (!$changed) {
            return [];
        }
        
        return ['action' => 'success']; 
    }


   /**
     * Get stores items
     *
     * @return array
     */
    public function storeItems(int $userId, int $storeId, int $categoryId, string $name, string $url): array
    {
        $items = ShoppingItems::firstOrCreate([
                    'name' => $name,
                    'url' => $url,
                    'store_id' => $storeId, 
                    'user_id' => $userId
                ]);
        if (!$items) {
            return [];
        }

        $categories = ShoppingItemsCategory::firstOrCreate([
            'sh_item_id' => $items->sh_item_id,
            'sh_category_id' => $categoryId,
            'user_id' => $userId,
            'created_at' => date('Y-m-d H:m:s'),
            'updated_at' => date('Y-m-d H:m:s'),
        ]);

        if (!$categories) {
            return [];
        }


        return ['action' => 'success']; 
    }


   /**
     * Get stores items
     *
     * @return array
     */
    public function updateItems(int $userId, array $fields): array
    {

        try {
            $items = ShoppingItems::where([
                'sh_item_id' => $fields['item_id'],
                'user_id' => $userId
            ])->update([
                'name' => $fields['item_name'],
                'url' => $fields['item_url'],
                'store_id' => $fields['store']
            ]);
    
            $categories = ShoppingItemsCategory::where([
                'sh_item_id' => $fields['item_id'],
                'user_id' => $userId,
            ])->update([
                'sh_category_id' => $fields['category'],
                'updated_at' => date('Y-m-d H:m:s'),
            ]);
        } catch (\Throwable $th) {
            (new LogsService)->handle('error.updateItems', 'Error while updating Items ' . $th->getMessage());
            return [];
        }
        
        return ['action' => 'success']; 
    }




    /**
     * Get users items list
     *
     * @return bool
     */
    public function stores(): object
    {
        return $this->shoppingRepository->stores();
    }
}