<?php

namespace App\Filters\Job;

class YOEFilter
{
    public function filter($builder, $value)
    {
        return $builder->where('year_of_experience', $value);
    }
}
