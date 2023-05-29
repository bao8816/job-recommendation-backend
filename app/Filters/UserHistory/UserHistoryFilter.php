<?php

namespace App\Filters\UserHistory;

use App\Filters\AbstractFilter;

class UserHistoryFilter extends AbstractFilter
{
    protected $filters = [
        'user_id' => UserFilter::class,
        'job_id' => JobFilter::class,
    ];
}
