<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;

class TimeTable extends Model
{
    use HasFactory;

    protected $connection = 'mongodb';
    protected $collection = 'time_tables';

    protected $casts = [
        'time_table' => 'array',
    ];

    protected $fillable = [
        'time_table',
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
    ];

//    protected function timeTable(): Attribute
//    {
//        return Attribute::make(
//            get: fn ($value) => json_decode($value, true),
//            set: fn ($value) => json_encode($value),
//        );
//    }
}
