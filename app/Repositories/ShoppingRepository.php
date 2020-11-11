<?php

namespace App\Repositories;

use App\Models\ShoppingItems;
use App\Models\ShoppingCategories;
use App\Models\ShoppingCategoriesUser;
use App\Models\ShoppingItemsCategory;
use App\Models\Stores;

class ShoppingRepository
{
    /**
     * Get users items list
     *
     * @return collection
     */
    public function items(int $userId)
    {
        return ShoppingItems::where('user_id', $userId)
                            ->get();
    }

    /**
     * Get users items list
     *
     * @return collection
     */
    public function item(int $itemId, int $userId)
    {
        return ShoppingItems::where([
                            ['shopping_items.sh_item_id', $itemId],
                            ['shopping_items.user_id', $userId],
                        ])
                        ->first();
    }


    /**
     * Return categorized items
     *
     * @return collection
     */
    public function categorizedItems($categoryId, $userId)
    {
        return ShoppingItemsCategory::select([
            'shopping_items_category.sh_item_id', 
            'shopping_items.name', 
            'shopping_items.amount',
            'shopping_items.price',
            'shopping_items.ml',
            'shopping_items.grams',
            'shopping_items.url', 
            'stores.name as store_name'
        ])
        ->where([
            ['shopping_items_category.sh_category_id', $categoryId],
            ['shopping_items_category.user_id', $userId],
        ])
        ->join('shopping_items', 'shopping_items_category.sh_item_id', 'shopping_items.sh_item_id')
        ->join('stores', 'stores.store_id', 'shopping_items.store_id')
        ->get();
    }


    /**
     * Get users items list
     *
     * @return array
     */
    public function find(int $userId, int $itemId)
    {
        return ShoppingItems::where([
                                ['user_id', $userId],
                                ['shopping_item_id', $itemId]
                            ])
                            ->first();
    }

    public function getItemCategory($itemId, $userId)
    {
        return ShoppingItemsCategory::where([
                    ['sh_item_id', $itemId],
                    ['user_id', $userId],
                ])->first();
    }


    /**
     * Get Stores
     *
     * @return collection
     */
    public function stores()
    {
        return Stores::get();
    }

    /**
     * Get users categories list
     *
     * @return collection
     */
    public function categories(int $userId): object
    {
        return ShoppingCategoriesUser::where('user_id', $userId)
                    ->join('shopping_categories', 'shopping_categories.sh_category_id', 'shopping_categories_user.sh_category_id')
                    ->orderBy('shopping_categories_user.status', 'DESC')
                    ->orderBy('shopping_categories.name', 'ASC')
                    ->get();
    }

    /**
     * Find specific category
     *
     * @return collection
     */
    public function category(int $categoryId, int $userId): object
    {
        return ShoppingCategoriesUser::where([
                        ['user_id', $userId],
                        ['sh_categories_user_id', $categoryId],
                ])
                ->join('shopping_categories', 'shopping_categories.sh_category_id', 'shopping_categories_user.sh_category_id')
                ->first();
    }

    /**
     * Find specific category
     *
     * @return collection
     */
    public function updateCategoryStatus(int $userId, int $categoryId, int $changeValue)
    {
        $shoppingCategoriesUser = ShoppingCategoriesUser::join('shopping_categories', 'shopping_categories.sh_category_id', 'shopping_categories_user.sh_category_id')
            ->where('user_id', $userId)
            ->where('sh_categories_user_id', $categoryId)
            ->first();
        
        $shoppingCategoriesUser->status = $changeValue;
        if (!$shoppingCategoriesUser->save()) {
            return [];
        }

        return ['action' => 'success'];
    }
}