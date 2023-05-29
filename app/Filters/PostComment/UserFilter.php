<?php

namespace App\Filters\PostComment;

class UserFilter
{
    public function filter($builder, $value)
    {
        return $builder->where('user_id', $value);
    }
}
