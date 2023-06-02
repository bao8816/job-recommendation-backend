<?php

namespace App\Filters\EmployerAccount;

use App\Filters\AbstractFilter;

class EmployerAccountFilter extends AbstractFilter
{
    protected $filters = [
        'company_id' => CompanyFilter::class,
    ];
}
