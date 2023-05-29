<?php

namespace App\Filters\CV;

use App\Filters\AbstractFilter;

class CVFilter extends AbstractFilter
{
    protected $filters = [
        'user_id' => UserFilter::class,
    ];
}
