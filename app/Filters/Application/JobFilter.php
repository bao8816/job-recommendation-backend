<?php

namespace App\Filters\Application;

class JobFilter
{
    public function filter($builder, $value)
    {
        return $builder->where('job_id', $value);
    }
}
