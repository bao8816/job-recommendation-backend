<?php

namespace App\Filters\JobReport;

class UserFilter
{
    public function filter($builder, $value)
    {
        return $builder->where('user_id', $value);
    }
}
