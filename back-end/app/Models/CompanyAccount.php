<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

class CompanyAccount extends Model
{
    use HasFactory, SoftDeletes;

    protected $connection = 'mysql';
    protected $table = 'company_accounts';

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
}
