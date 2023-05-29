<?php

namespace App\Http\Controllers;

use App\Http\Requests\Subreddit\SubredditRequest;
use App\Http\Requests\Subreddit\SubredditStoreRequest;
use App\Http\Requests\Subreddit\SubredditUpdateRequest;
use App\Http\Resources\Subreddit\SubredditResource;
use App\Http\Services\SubredditService;
use App\Models\Subreddit;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\JsonResponse;

class SubredditController extends Controller
{
    /**
     * @throws AuthorizationException
     */
    public function index(SubredditRequest $request): JsonResponse
    {
        /** @var SubredditService $subredditService */
        $subredditService = app(SubredditService::class);
        $this->authorize('viewAny', [Subreddit::class, $request]);
        $subreddits = $subredditService->list($request->validated());

        return SubredditResource::collection($subreddits)
            ->response();
    }

    /**
     * @throws AuthorizationException
     */
    public function store(SubredditStoreRequest $request): JsonResponse
    {
        /** @var SubredditService $subredditService */
        $subredditService = app(SubredditService::class);
        $this->authorize('create', [Subreddit::class, $request]);
        $create = $subredditService->store($request->validated());

        return SubredditResource::make($create)
            ->response();
    }

    /**
     * @throws AuthorizationException
     */
    public function show(SubredditRequest $request, int $subredditId): JsonResponse
    {
        /** @var SubredditService $subredditService */
        $subredditService = app(SubredditService::class);
        $subreddit = $subredditService->show($subredditId);
        $this->authorize('view', [$subreddit, $request]);

        return SubredditResource::make($subreddit)
            ->response();
    }

    /**
     * @throws AuthorizationException
     */
    public function update(SubredditUpdateRequest $request, int $subredditId): JsonResponse
    {
        /** @var SubredditService $subredditService */
        $subredditService = app(SubredditService::class);
        /** @var Subreddit $subreddit */
        $subreddit = $subredditService->show($subredditId);
        $this->authorize('view', [$subreddit, $request]);
        $update = $subredditService->update($request->validated(), $subreddit);

        return SubredditResource::make($update)
            ->response();
    }

    /**
     * @throws AuthorizationException
     */
    public function destroy(SubredditRequest $request, int $subredditId): JsonResponse
    {
        /** @var SubredditService $subredditService */
        $subredditService = app(SubredditService::class);
        /** @var Subreddit $subreddit */
        $subreddit = $subredditService->show($subredditId);
        $this->authorize('view', [$subreddit, $request]);
        $delete = $subredditService->delete($subreddit);
        if ($delete) {
            return response()
                ->json(['message' => 'Subreddit has been deleted']);
        }

        return response()
            ->json($delete);
    }
}
