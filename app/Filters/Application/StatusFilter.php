<?php

namespace App\Filters\Application;

class StatusFilter
{
    public function filter($builder, $value)
    {
        switch ($value) {
            case '0':
                return $builder->where('status', 'Đang chờ');
                break;
            case '1':
                return $builder->where('status', 'Đã duyệt');
                break;
            case '2':
                return $builder->where('status', 'Đã từ chối');
                break;
            default:
                return $builder;
                break;
        }
    }
}
