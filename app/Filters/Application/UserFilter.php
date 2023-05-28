<?php

namespace App\Filters\Application;

class UserFilter
{
    public function filter($builder, $value)
    {
        return $builder->where('user_id', $value);
    }
}
