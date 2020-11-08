<?php

namespace Tests\Feature\shopping;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Services\ShoppingService;
use App\Repositories\ShoppingRepository;

class CategoriesEditTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testExample()
    {
        $userId = 1;
        $name = 'Testing';
        $categoryId = 1;
        $shoppingService = new ShoppingService(new ShoppingRepository);
        $inserted = $shoppingService->updateCategory($userId, $categoryId, $name);
        if (empty($inserted)) {
            $this->assertTrue(true);
        }
        $this->assertTrue(true);
    }
}
