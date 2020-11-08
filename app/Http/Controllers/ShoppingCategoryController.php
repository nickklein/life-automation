<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\ShoppingService;
use Illuminate\Support\Facades\Validator;
use Auth;

class ShoppingCategoryController extends Controller
{
    public function index(ShoppingService $shoppingService)
    {
        return view('pages.shopping.categories.index', ['data' => $shoppingService->categories(Auth::user()->id)]);
    }

    public function create(ShoppingService $shoppingService)
    {
        return view('pages.shopping.categories.create');
    }

    public function store(Request $request, ShoppingService $shoppingService)
    {
    
        $validator = Validator::make($request->all(), [
            'category_name' => 'required|string',
        ]);

        if ($validator->fails()) {
            return back()
                        ->withErrors($validator)
                        ->withInput();
        }
        
        $fields = $request->all();
        $response = $shoppingService->storeCategory(Auth::user()->id, $fields['category_name']);

        if (empty($response)) {
            return back()->with(['message' => __("Couldn't save. Please try again later.")]);
        }

        return back()->with(['message' => __('Saved')]);
    }

    public function show($categoryId, ShoppingService $shoppingService)
    {              
        return view('pages.shopping.categories.show', ['data' => $shoppingService->category($categoryId, Auth::user()->id, true)]);
    }

    public function edit($categoryId, ShoppingService $shoppingService)
    {              
        return view('pages.shopping.categories.edit', ['data' => $shoppingService->category($categoryId, Auth::user()->id)]);
    }

    public function update(Request $request, ShoppingService $shoppingService)
    {
        $validator = Validator::make($request->all(), [
            'category_name' => 'required|string',
            'category_id' => 'required|int'
        ]);

        if ($validator->fails()) {
            return back()
                        ->withErrors($validator)
                        ->withInput();
        }
        
        $fields = $request->all();
        $response = $shoppingService->updateCategory(Auth::user()->id, $fields['category_id'], $fields['category_name']);

        if (empty($response)) {
            return back()->with(['message' => __("Couldn't save. Please try again later.")]);
        }

        return back()->with(['message' => __('Saved')]);
    }
}
