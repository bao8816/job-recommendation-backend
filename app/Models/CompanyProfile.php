<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class CompanyProfile extends Model
{
    use HasFactory, SoftDeletes;

    protected $connection = 'mysql';
    protected $table = 'company_profiles';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'logo',
        'description',
        'site',
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

    // belongsTo
    public function account(): BelongsTo
    {
        return $this->belongsTo(CompanyAccount::class, 'id', 'id');
    }
}
