<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class CompanyAccount extends Model
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

    public function profile(): HasOne
    {
        return $this->hasOne(CompanyProfile::class, 'id', 'id');
    }

    public function company_verification(): HasOne
    {
        return $this->hasOne(CompanyVerification::class, 'company_id', 'id');
    }
}
