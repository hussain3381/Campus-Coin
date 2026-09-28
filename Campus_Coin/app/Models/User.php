<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'academic_year',
        'allowance_baseline',
        'savings_goal',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'allowance_baseline' => 'decimal:2',
            'savings_goal' => 'decimal:2',
        ];
    }
public function transactions(): HasMany
{
    return $this->hasMany(Transaction::class);
}

public function categories(): HasMany
{
    return $this->hasMany(Category::class);
}

public function budgets(): HasMany
{
    return $this->hasMany(Budget::class);
}  

public function savingTips(): BelongsToMany
{
    return $this->belongsToMany(SavingTip::class, 'user_saving_tips')
        ->withPivot('is_pinned', 'is_dismissed')
        ->withTimestamps();
}


}
