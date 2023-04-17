<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class JobReport extends Model
{
    use HasFactory;

    protected $connection = 'mysql';
    protected $table = 'job_reports';

    public function job(): BelongsTo
    {
        return $this->belongsTo(Job::class, 'job_id', 'id');
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(UserAccount::class, 'user_id', 'id');
    }
}
