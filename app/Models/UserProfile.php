<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class UserProfile extends Model
{
    use HasFactory, SoftDeletes;

    protected $connection = 'mysql';
    protected $table = 'user_profiles';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'full_name',
        'avatar',
        'date_of_birth',
        'gender',
        'address',
        'email',
        'phone',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function account(): BelongsTo
    {
        return $this->belongsTo(UserAccount::class, 'id', 'id');
    }

    public function educations(): HasMany
    {
        return $this->hasMany(UserEducation::class, 'user_id', 'id');
    }

    public function cvs(): HasMany
    {
        return $this->hasMany(CV::class, 'user_id', 'id');
    }

    public function experiences(): HasMany
    {
        return $this->hasMany(UserExperience::class, 'user_id', 'id');
    }

    public function achievements(): HasMany
    {
        return $this->hasMany(UserAchievement::class, 'user_id', 'id');
    }

    public function skills(): HasMany
    {
        return $this->hasMany(UserSkill::class, 'user_id', 'id');
    }

    public function applications(): HasMany
    {
        return $this->hasMany(Application::class, 'user_id', 'id');
    }

    public function job_reports(): HasMany
    {
        return $this->hasMany(JobReport::class, 'user_id', 'id');
    }

    public function company_reports(): HasMany
    {
        return $this->hasMany(CompanyReport::class, 'user_id', 'id');
    }

    public function post_comments(): HasMany
    {
        return $this->hasMany(PostComment::class, 'user_id', 'id');
    }

    public function time_tables(): HasMany
    {
        return $this->hasMany(TimeTable::class, 'user_id', 'id');
    }

    public function user_history(): HasMany
    {
        return $this->hasMany(UserHistory::class, 'user_id', 'id');
    }
}
