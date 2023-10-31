<?php

namespace App\Models;

use App\Events\SweepstakeCreated;
use App\Models\Enums\SweepstakeStatus;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Sweepstake extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'name',
        'slug',
        'description',
        'image_card',
        'image_page',
        'price',
        'minimum_amount',
        'status',
        'number_of_quotas',
        'remaining_blocks',
        'is_active',
        'affiliates',
        'affiliates_percent',
        'affiliates_type',
        'draw_date',
        'event_date',
    ];

    protected $casts = [
        'draw_date' => 'datetime',
        'event_date' => 'datetime',
    ];

    protected static function booted()
    {
        static::creating(function ($model) {
            $model->uuid = Str::uuid();
            $model->slug = Str::slug($model->name);
        });

        static::created(function ($model) {
            event(new SweepstakeCreated($model));

            if ($model->minimum_amount <= 0) {
                $model->minimum_amount = 1;
                $model->save();
            }
        });
    }

    public function scopeActive(Builder $builder): Builder
    {
        return $builder->where('is_active', true)->where('status', SweepstakeStatus::AVAILABLE);
    }

    public function scopeClosed(Builder $builder): Builder
    {
        return $builder->where('is_active', true)->where('status', SweepstakeStatus::CLOSED);
    }

    public function scopeCompleted(Builder $builder): Builder
    {
        return $builder->where('is_active', true)->where('status', SweepstakeStatus::COMPLETED);
    }

    public function quotas(): HasMany
    {
        return $this->hasMany(Quota::class);
    }

    public function orders()
    {
        return $this->hasMany(Order::class, 'sweepstake_id');
    }

}
