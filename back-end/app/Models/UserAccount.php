<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Foundation\Auth\User as Authenticatable;

class UserAccount extends Authenticatable
{
    use HasFactory, HasApiTokens, Notifiable;

    protected $connection = 'mysql';
    protected $table = 'user_accounts';

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
    ];

    public function profile(): HasOne
    {
        return $this->hasOne(UserProfile::class, 'id', 'id');
    }

    public function education(): HasMany
    {
        return $this->hasMany(UserEducation::class, 'user_id', 'id');
    }

    public function cv(): HasMany
    {
        return $this->hasMany(CV::class, 'user_id', 'id');
    }

    public function experience(): HasMany
    {
        return $this->hasMany(UserExperience::class, 'user_id', 'id');
    }

    public function achievement(): HasMany
    {
        return $this->hasMany(UserAchievement::class, 'user_id', 'id');
    }
}
