<?php

namespace App\Services;

use App\Models\Logs;
use Illuminate\Support\Facades\Auth;
use App\Repositories\NewsRepository;
use App\Models\SourcesFavourites;
use App\Models\Tags;
use App\Models\UserTags;
use App\Models\UserSources;
use App\Models\Sources;

class NewsService
{
    private $newsRepository;
    CONST PAGINATE_LIMIT = 50;

    public function __construct(NewsRepository $service)
    {
       $this->newsRepository = $service;
    }

    /**
     * Get list of personalized user lists
     *
     * @return collection
     */
    public function list(int $userId): object
    {
        $list = $this->newsRepository->list($userId, self::PAGINATE_LIMIT);
        $list->map(function($item) use ($userId) {
            $item->favorited = $this->newsRepository->favoriteExist($item->source_link_id, $userId) ? 1 : 0;
            $item->favorited_label = 'Add to Favorites';
            if ($item->favorited) {
                $item->favorited_label = 'Remove from Favorites';
            }

            return $item;
        });

        return $list;
    }

    /**
     * Get list of personalized tags
     *
     * @return collection
     */
    public function listTags(int $userId): object
    {
        return $this->newsRepository->listTags($userId);
    }

    /**
     * create tags for user
     *
     * @return collection
     */
    public function createTag(int $userId, string $tagName)
    {
        // Find Tag through repo
        $tags = Tags::firstOrCreate([
            'tag_name' => $tagName
        ]);

        return UserTags::create([
            'tag_id' => $tags->tag_id,
            'user_id' => $userId,
        ]);
    }

    /**
     * destroy tags for user
     *
     * @return collection
     */
    public function destroyTag(int $userId, string $tagName): array
    {
        $tag = $this->newsRepository->findTag($tagName);
        if (empty($tag)) {
            return [];
        }

        $userTag = $this->newsRepository->findUserTag($userId, $tag->tag_id);
        if (!$userTag->delete()) {
            return [];
        }

        return ['action' => 'success'];
    }

    /**
     * list sources for user
     *
     * @return collection
     */
    public function listSources(int $userId): object
    {
        $sources = Sources::all();
        $userSources = UserSources::where('user_id', $userId)->get();

        # Add active state
        foreach($sources as $sourceItem) {
            foreach($userSources as $userItem) {
                if ($sourceItem->source_id == $userItem->source_id) {
                    $sourceItem->active = true;
                }
            }
        }
        
        return $sources;
    }


    /**
     * update sources for user
     *
     * @return collection
     */
    public function updateSources(int $userId, int $sourceId, bool $active)
    {
        if (!$active) {
            $userSourceRel = UserSources::where('source_id', '=', $sourceId);
            $userSourceRel->delete();
        } else {
            $userSourceRel = new UserSources;
            $userSourceRel->user_id = $userId;
            $userSourceRel->source_id = $sourceId;
            $userSourceRel->save();
        }

        return ['action' => 'success'];
    }

    /**
     * Favourite/Unfavorite
     *
     * @return collection
     */  
    public function favourite(int $userId, int $sourceLinkId, $status)
    {
        if ($this->newsRepository->favoriteExist($sourceLinkId, $userId)) {
            SourcesFavourites::where([
                'source_link_id' => $sourceLinkId,
                'user_id' => $userId
            ])->delete();
        } else {
            SourcesFavourites::create([
                'source_link_id' => $sourceLinkId,
                'user_id' => $userId
            ]);
        }
    }

}