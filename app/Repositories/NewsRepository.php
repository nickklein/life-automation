<?php

namespace App\Repositories;

use App\Models\NewsSummary;
use App\Models\UserTags;
use App\Models\SourcesFavourites;
use App\Models\Tags;
use Carbon\Carbon;

class NewsRepository
{
    /**
     * Get list of personalized user lists
     *
     * @return collection
     */
    const DAYS = 1;

    public function list(int $userId, $paginate)
    {
        try {
            //code...
            $expiredDate = Carbon::now()
                                ->subDays(self::DAYS)
                                ->format('Y-m-d H:m:s');

            return NewsSummary::selectRaw('sum(points) as points, GROUP_CONCAT(tag_name SEPARATOR ", ") as tag_name, count(tag_name) as tag_count, source_links.source_link_id, source_links.source_title, source_links.source_date, source_links.source_link, sources.source_name')
                ->join('source_links', 'news_summary.source_link_id', '=', 'source_links.source_link_id')
                ->join('sources', 'source_links.source_id', '=', 'sources.source_id')
                ->join('tags', 'tags.tag_id', 'news_summary.tag_id')
                ->where('news_summary.user_id', $userId)
                ->where([
                    ['active', 1],
                    ['source_links.created_at', '>', $expiredDate]
                ])
                ->groupBy('news_summary.source_link_id')
                ->orderBy('points', 'DESC')
                ->orderBy('tag_count', 'ASC')
                ->orderBy('source_date', 'DESC')
                ->paginate($paginate);
        } catch (\Throwable $th) {
            (new LogsService)->handle('error.newsSummaryList', 'Summary ' . $th->getMessage());
        }
    }

    /**
     * Get list of personalized tags
     *
     * @return collection
     */
    public function listTags(int $userId)
    {
        return UserTags::get()
                        ->load('tag')
                        ->where('user_id', $userId);
    }

    /**
     * Find Tag
     *
     * @return collection
     */
    public function findTag(string $tag)
    {
        return Tags::where('tag_name', $tag)->first();
    }

    /**
     * Find Tag
     *
     * @return collection
     */
    public function findUserTag(int $userId, int $tagId)
    {
        return UserTags::where('tag_id', $tagId)
                        ->where('user_id', $userId)
                        ->first();
    }

    /**
     * Check if source is favorited
     *
     * @return collection
     */
    public function favoriteExist(int $sourceLinkId, int $userId): bool
    {
        return SourcesFavourites::where([
            'source_link_id' => $sourceLinkId,
            'user_id' => $userId
        ])->exists();
    }
}