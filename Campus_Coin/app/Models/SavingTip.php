<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class SavingTip extends Model
{
    protected $fillable = [
        'category_id',
        'title',
        'description',
        'estimated_saving_pkr',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'estimated_saving_pkr' => 'decimal:2',
    ];

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'user_saving_tips')
            ->withPivot('is_pinned', 'is_dismissed')
            ->withTimestamps();
    }
}