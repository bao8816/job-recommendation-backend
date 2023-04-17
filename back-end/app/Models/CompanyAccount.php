<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class CompanyAccount extends Model
{
    use HasFactory;

    protected $connection = 'mysql';
    protected $table = 'company_accounts';

    public function company_reports(): HasMany
    {
        return $this->hasMany(CompanyReport::class, 'company_id', 'id');
    }
}
