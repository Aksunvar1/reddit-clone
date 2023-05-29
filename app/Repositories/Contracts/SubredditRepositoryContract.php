<?php

namespace App\Repositories\Contracts;

interface SubredditRepositoryContract
{
    public function list(array $params);
}
