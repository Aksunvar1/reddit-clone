<?php

namespace App\Policies;

use App\Models\Subreddit;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;

class SubredditPolicy
{
    use HandlesAuthorization;

    public function delete(User $user, Subreddit $subreddit): Response
    {
        if (! $user->is_admin) {
            return Response::deny('Not admin');
        }
        if (! in_array($user, $subreddit->moderators)) {
            return Response::deny('Not moderator');
        }

        return Response::allow();
    }
}
