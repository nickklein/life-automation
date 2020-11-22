<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\NewsService;
use App\Http\Requests\FavouriteRequest;
use Illuminate\Support\Facades\Auth;

class NewsController extends Controller
{
    public function favourites(FavouriteRequest $request, NewsService $service)
    {
        $fields = $request->validated();
        $service->favourite(Auth::user()->id, $fields['source_link_id'], $fields['status']);
    }
}
