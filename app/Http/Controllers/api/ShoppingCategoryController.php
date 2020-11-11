<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\CategoryRequest;
use App\Services\ShoppingService;
use Auth;

class ShoppingCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function update(CategoryRequest $request, ShoppingService $service)
    {
        $fields = $request->validated();
        $service->updateCategoryStatus(Auth::user()->id, $fields['categoryId'], $fields['changeValue']);
    }
}
