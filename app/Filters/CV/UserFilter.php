<?php

namespace App\Filters\CV;

class UserFilter
{
    public function filter($builder, $value)
    {
        return $builder->where('user_id', $value);
    }
}
