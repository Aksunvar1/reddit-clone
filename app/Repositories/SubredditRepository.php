<?php

namespace App\Repositories;

use App\Helpers\Enums\SubredditStatusEnum;
use App\Models\Subreddit;
use App\Repositories\Contracts\SubredditRepositoryContract;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Pagination\LengthAwarePaginator;

class SubredditRepository implements SubredditRepositoryContract
{
    public function list(array $params): LengthAwarePaginator
    {
        //todo private subs where you are a member will be added later
        return Subreddit::query()
            ->where(function (Builder $query) {
                $query
                    ->where('status', SubredditStatusEnum::Public->value);
            })
            ->orderBy($params['order_by'], $params['sort'])
            ->paginate($params['per_page']);
    }
}
