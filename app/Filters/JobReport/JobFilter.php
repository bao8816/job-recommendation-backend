<?php

namespace App\Filters\JobReport;

class JobFilter
{
    public function filter($builder, $value)
    {
        return $builder->where('job_id', $value);
    }
}
