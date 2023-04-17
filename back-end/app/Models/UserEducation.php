<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class UserEducation extends Model
{
    use HasFactory;

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
        'start',
        'end',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'created_at',
        'updated_at',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(UserAccount::class, 'user_id', 'id');
    }
}
