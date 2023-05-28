<?php

namespace App\Filters\Application;

class StatusFilter
{
    public function filter($builder, $value)
    {
        switch ($value) {
            case '0':
                return $builder->where('status', 'Đang chờ');
            case '1':
                return $builder->where('status', 'Đã duyệt');
            case '2':
                return $builder->where('status', 'Đã từ chối');
            default:
                return $builder;
        }
    }
}
