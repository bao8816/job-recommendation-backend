<?php

namespace App\Filters\Job;

use App\Filters\AbstractFilter;

class JobFilter extends AbstractFilter
{
    protected $filters = [
        'min_yoe' => MinYOEFilter::class,
        'max_yoe' => MaxYOEFilter::class,
        'min_sal' => MinSalaryFilter::class,
        'max_sal' => MaxSalaryFilter::class,
        'employer_id' => EmployerFilter::class,
        'company_id' => CompanyFilter::class,
        'available' => AvailableFilter::class,
        'top' => TopFilter::class,
    ];
}
