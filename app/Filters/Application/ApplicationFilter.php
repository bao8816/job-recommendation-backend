<?php

namespace App\Filters\Application;

use App\Filters\AbstractFilter;

class ApplicationFilter extends AbstractFilter
{
    protected $filters = [
        'company_id' => CompanyFilter::class,
    ];
}
