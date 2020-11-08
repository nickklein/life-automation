<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\ShoppingService;
use Illuminate\Support\Facades\Validator;
use Auth;

class ShoppingItemController extends Controller
{
    public function index(ShoppingService $shoppingService)
    {   
        return view('pages.shopping.items.index', ['data' => $shoppingService->items(Auth::user()->id)]);
    }

    public function create(ShoppingService $shoppingService)
    {
        return view('pages.shopping.items.create', ['stores' => $shoppingService->stores(), 'categories' => $shoppingService->categories(Auth::user()->id)]);
    }

    public function edit($itemId, ShoppingService $shoppingService)
    {              
        return view('pages.shopping.items.edit', [
            'item' => $shoppingService->item($itemId, Auth::user()->id), 
            'stores' =>  $shoppingService->stores(), 
            'categories' => $shoppingService->categories(Auth::user()->id)
        ]);
    }

    public function store(Request $request, ShoppingService $shoppingService)
    {
        $validator = Validator::make($request->all(), [
            'item_name' => 'required|string',
            'item_url' => 'required|string',
            'category' => 'required|int',
            'store' => 'required|int',
        ]);

        if ($validator->fails()) {
            return back()
                        ->withErrors($validator)
                        ->withInput();
        }
        
        $fields = $request->all();
        $response = $shoppingService->storeItems(Auth::user()->id, $fields['store'], $fields['category'], $fields['item_name'], $fields['item_url']);

        if (empty($response)) {
            return back()->with(['message' => __("Couldn't save. Please try again later.")]);
        }

        return back()->with(['message' => __('Saved')]);
    }

    public function update(Request $request, ShoppingService $shoppingService)
    {
        $validator = Validator::make($request->all(), [
            'item_id' => 'required|int',
            'item_name' => 'required|string',
            'item_url' => 'required|string',
            'category' => 'required|int',
            'store' => 'required|int',
        ]);

        if ($validator->fails()) {
            return back()
                        ->withErrors($validator)
                        ->withInput();
        }
        
        $fields = $request->all();
        $response = $shoppingService->updateItems(Auth::user()->id, $fields);

        if (empty($response)) {
            return back()->with(['message' => __("Couldn't save. Please try again later.")]);
        }

        return back()->with(['message' => __('Saved')]);
    }

}
