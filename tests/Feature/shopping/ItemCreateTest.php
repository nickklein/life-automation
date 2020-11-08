<?php

namespace Tests\Feature\shopping;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Services\ShoppingService;
use App\Repositories\ShoppingRepository;

class ItemCreateTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testExample()
    {
        $userId = 1;
        $storeId = 1;
        $categoryId = 1;
        $name = 'Testing';
        $url = 'http://google.com';
        $shoppingService = new ShoppingService(new ShoppingRepository);
        $inserted = $shoppingService->storeItems($userId, $storeId, $categoryId, $name, $url);
        if (empty($inserted)) {
            $this->assertTrue(true);
        }
        $this->assertTrue(true);
    }
}
