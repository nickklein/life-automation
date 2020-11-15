<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\NewsService;
use Auth;

class NewsController extends Controller
{
    public function index(NewsService $service)
    {
        return view('pages.news.index', ['links' => $service->list(Auth::user()->id)]);
    }
}
