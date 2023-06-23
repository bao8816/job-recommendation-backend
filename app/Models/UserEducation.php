<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class UserEducation extends Model
{
    use HasFactory, SoftDeletes;

    protected $connection = 'mysql';
    protected $table = 'user_educations';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'university',
        'major',
        'start',
        'end',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'deleted_at',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(UserAccount::class, 'user_id', 'id');
    }

    public function user_profile(): BelongsTo
    {
        return $this->belongsTo(UserProfile::class, 'user_id', 'id');
    }
}
