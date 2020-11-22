<?php

namespace App\Http\Controllers\api\settings;

use App\Http\Controllers\Controller;
use App\Http\Resources\TagsResource;
use  App\Http\Requests\TagsRequest;
use Illuminate\Http\Request;
use App\Services\NewsService;
use Auth;

class TagsController extends Controller
{
    public function index(NewsService $newsService)
    {
        $newsService->listSources(Auth::user()->id);
        return TagsResource::collection($newsService->listTags(Auth::user()->id));
    }

    public function store(TagsRequest $request, NewsService $newsService)
    {
        $fields = $request->validated();
        $response = $newsService->createTag(Auth::user()->id, $fields['tag_name']);
        if (empty($response)) {
            return response()->json(['action' => 'error', 'message' => 'Something went wrong with inserting to the database']);
        }

        return response()->json(['action' => 'success']);
    }

    public function destroy(TagsRequest $request, NewsService $newsService)
    {
        $fields = $request->validated();
        $response = $newsService->destroyTag(Auth::user()->id, $fields['tag_name']);
        if (empty($response)) {
            return response()->json(['action' => 'error', 'message' => 'Something went wrong with inserting to the database']);
        }

        return response()->json(['action' => 'success']);
    }
}
