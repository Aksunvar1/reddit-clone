<?php

namespace App\Helpers\Enums;

enum SubredditStatusEnum: string
{
    case Public = 'public';
    case Private = 'private';
    case Restricted = 'restricted';
    case Deleted = 'deleted';
}
