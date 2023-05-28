<?php

namespace App\Filters\Application;

use App\Filters\AbstractFilter;

class ApplicationFilter extends AbstractFilter
{
    protected $filters = [
        'company_id' => CompanyFilter::class,
        'job_id' => JobFilter::class,
        'user_id' => UserFilter::class,
    ];
}
