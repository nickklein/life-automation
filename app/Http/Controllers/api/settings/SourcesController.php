<?php

namespace App\Http\Controllers\api\settings;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Resources\SourcesResources;
use  App\Http\Requests\SourcesRequest;
use App\Services\NewsService;
use Auth;

class SourcesController extends Controller
{
    public function index(NewsService $newsService)
    {
        return SourcesResources::collection($newsService->listSources(Auth::user()->id));
    }

    public function update(SourcesRequest $request, NewsService $newsService)
    {
        $fields = $request->validated();
        $response = $newsService->updateSources(Auth::user()->id, $fields['source_id'], $fields['active']);
        if (empty($response)) {
            return response()->json(['action' => 'error', 'message' => 'Something went wrong with inserting to the database']);
        }

        return response()->json(['action' => 'success']);
    }
}
