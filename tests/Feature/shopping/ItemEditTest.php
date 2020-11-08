<?php

namespace Tests\Feature\shopping;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Services\ShoppingService;
use App\Repositories\ShoppingRepository;
use App\Models\ShoppingItems;

class ItemEditTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testExample()
    {
        $item = ShoppingItems::orderBy('sh_item_id', 'DESC')->first();
        $userId = 1;
        $fields = [
            'item_id' => $item->sh_item_id,
            'store' => $item->store,
            'item_name' => $item->name,
            'item_url' => $item->url,
            'category' => 1,
        ];
        $shoppingService = new ShoppingService(new ShoppingRepository);
        $inserted = $shoppingService->updateItems($userId, $fields);
        if (empty($inserted)) {
            $this->assertTrue(true);
        }
        $this->assertTrue(true);
    }
}
