<?php

namespace App\Http\Services;

use App\Helpers\Enums\SubredditStatusEnum;
use App\Models\Subreddit;
use App\Repositories\Contracts\SubredditRepositoryContract;
use Illuminate\Database\Eloquent\Model;

class SubredditService
{
    public function list(array $params)
    {
        /** @var SubredditRepositoryContract $subredditRepository */
        $subredditRepository = app(SubredditRepositoryContract::class);

        return $subredditRepository->list($params);
    }

    public function store(array $params): ?Model
    {
        $subreddit = Subreddit::query()
            ->create($params);

        return $subreddit;
    }

    public function show(int $subredditId): ?Model
    {
        return Subreddit::query()
            ->where('id', '=', $subredditId)
            ->firstOrFail();
    }

    public function update(array $params, Subreddit $subreddit): ?Model
    {
        $subreddit->update($params);

        return $subreddit->refresh();
    }

    public function delete(Subreddit $subreddit): ?bool
    {
        $subreddit->update([
            'status' => SubredditStatusEnum::Deleted,
        ]);

        return $subreddit->delete();
    }
}
