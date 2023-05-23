<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Job extends Model
{
    use HasFactory, SoftDeletes;

    protected $connection = 'mysql';
    protected $table = 'jobs';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'upvote',
        'downvote',
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

    public function employer(): BelongsTo
    {
        return $this->belongsTo(EmployerAccount::class, 'employer_id', 'id');
    }

    public function employer_profile(): BelongsTo
    {
        return $this->belongsTo(EmployerProfile::class, 'employer_id', 'id');
    }

    public function applications(): HasMany
    {
        return $this->hasMany(Application::class, 'job_id', 'id');
    }

    public function job_reports(): HasMany
    {
        return $this->hasMany(JobReport::class, 'job_id', 'id');
    }

    public function job_skills(): HasMany
    {
        return $this->hasMany(JobSkill::class, 'job_id', 'id');
    }

    public function job_types(): HasMany
    {
        return $this->hasMany(JobType::class, 'job_id', 'id');
    }

    public function job_locations(): HasMany
    {
        return $this->hasMany(JobLocation::class, 'job_id', 'id');
    }

    public function user_history(): HasMany
    {
        return $this->hasMany(UserHistory::class, 'job_id', 'id');
    }
}
