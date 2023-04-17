<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Jenssegers\Mongodb\Eloquent\Model;
use Jenssegers\Mongodb\Relations\BelongsTo;

class PostReport extends Model
{
    use HasFactory;

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
