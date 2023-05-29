<?php

namespace App\Filters\UserHistory;

class JobFilter
{
    public function filter($builder, $value)
    {
        return $builder->where('job_id', $value);
    }
}
