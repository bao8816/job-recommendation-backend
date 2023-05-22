<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class EmployerProfile extends Model
{
    use HasFactory, SoftDeletes;

    protected $connection = 'mysql';
    protected $table = 'employer_profiles';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'full_name',
        'avatar',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'created_at',
        'updated_at',
    ];

    public function account(): BelongsTo
    {
        return $this->belongsTo(EmployerAccount::class, 'id', 'id');
    }

    public function company(): BelongsTo
    {
        return $this->belongsTo(CompanyAccount::class, 'company_id', 'id');
    }
}
