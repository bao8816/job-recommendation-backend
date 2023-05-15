<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class PostReport extends Model
{
    use HasFactory, SoftDeletes;

    protected $connection = 'mysql';
    protected $collection = 'post_reports';

    public function post(): BelongsTo
    {
        return $this->belongsTo(Post::class, 'post_id', 'id');
    }
    public function user(): BelongsTo
    {
        return $this->belongsTo(UserAccount::class, 'user_id', 'id');
    }
}
