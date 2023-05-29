<?php

namespace App\Filters\CompanyReport;

use App\Filters\AbstractFilter;

class CompanyReportFilter extends AbstractFilter
{
    protected $filters = [
        'company_id' => CompanyFilter::class,
        'user_id' => UserFilter::class,
    ];
}
