<?php

namespace App\Filters\SavedJob;

class JobFilter
{
    public function filter($builder, $value)
    {
        return $builder->where('job_id', $value);
    }
}
