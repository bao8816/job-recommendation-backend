<?php

namespace App\Filters\PostReport;

use App\Filters\AbstractFilter;

class PostReportFilter extends AbstractFilter
{
    protected $filters = [
        'post_id' => PostFilter::class,
        'user_id' => UserFilter::class,
    ];
}
