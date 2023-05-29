<?php

namespace App\Filters\PostComment;

use App\Filters\AbstractFilter;

class PostCommentFilter extends AbstractFilter
{
    protected $filters = [
        'post_id' => PostFilter::class,
        'user_id' => UserFilter::class,
    ];
}
