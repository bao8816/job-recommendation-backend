<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Foundation\Auth\User as Authenticatable;

class CompanyAccount extends Authenticatable
{
    use HasFactory, SoftDeletes, HasApiTokens, Notifiable;

    protected $connection = 'mysql';
    protected $table = 'company_accounts';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'username',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function reports(): HasMany
    {
        return $this->hasMany(CompanyReport::class, 'company_id', 'id');
    }

    public function employers(): HasMany
    {
        return $this->hasMany(EmployerProfile::class, 'company_id', 'id');
    }

    public function employer_profiles(): HasMany
    {
        return $this->hasMany(EmployerProfile::class, 'company_id', 'id');
    }

    public function profile(): HasOne
    {
        return $this->hasOne(CompanyProfile::class, 'id', 'id');
    }

    public function company_verifications(): HasMany
    {
        return $this->hasMany(CompanyVerification::class, 'company_id', 'id');
    }

    public function jobs(): HasMany
    {
        return $this->hasMany(Job::class, 'company_id', 'id');
    }
}
